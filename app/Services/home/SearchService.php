<?php

namespace App\Services\home;

use App\Helpers\CommonHelpers;
use App\Models\Category;
use App\Models\Course;
use App\Models\GroupClass;
use App\Models\LanguageISpeak;
use App\Models\PreferredLanguage;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchService
{
    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request): array
    {

        if (!empty($request->type)) {
            switch ($request->type) {
                case "tutors":
                    $data = $this->searchByTutors($request);
                    $type = "tutors";
                    break;
                case "group":
                    $data = $this->searchByGroup($request);
                    $type = "group";
                    break;
                default:
                    $data  = $this->searchByCourse($request);
                    $type = "course";
            }
        } else {
            $data = $this->searchByCourse($request);
            $type = "course";
        }

        return array_merge($data, array('type'=> $type));
    }


    /**
     * @param Request $request
     * @return array
     */
    private function searchByTutors(Request $request): array
    {
        $user_id = Auth::user()->id ?? null;
        $teachers = User::query()->where('firstname', 'LIKE', '%' . $request->keyword . '%')->orWhere('lastname', 'LIKE', '%' . $request->keyword . '%')->where('is_admin', 0)->orderBy('id', 'DESC')->paginate(15);

        foreach ($teachers as $row) {
            $row["preferred_lang"] = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
                ->where('preferred_languages.user_id', $row->id)->get(['categories.*']);
            $row["language_i_speak"] = LanguageISpeak::join('categories', 'categories.id', '=', 'language_i_speaks.language_id')
                ->where('language_i_speaks.user_id', $row->id)->get(['categories.*']);
            $row["rating"] = CommonHelpers::ratingUser($row->id);
        }
        $instructors = $this->getInstructors($user_id);
        return array(
            'tutors' => $teachers,
            'instructors' => $instructors,
            'free_course' => 0,
            'paid_course' => 0
        );

    }

    private function searchByCourse(Request $request): array
    {
        $user_id = Auth::user()->id ?? null;
        if ($request->type) {
            $course = Course::query()->where('title', 'LIKE', '%' . $request->keyword . '%')->where('type', strtoupper($request->type))->orderBy('id', 'DESC')->paginate(15);
        } else {
            $course = Course::query()->where('title', 'LIKE', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->paginate(15);
        }

        return $this->courseListInfo($course, $user_id);
    }

    /**
     * @param LengthAwarePaginator $course
     * @param $user_id
     * @return array
     */
    private function courseListInfo(LengthAwarePaginator $course, $user_id): array
    {
        (new CommonHelpers)->moreCourseInformation($course);

        $instructors = $this->getInstructors($user_id);

        $free_course = Course::query()->where('type', 'FREE')->count();
        $paid_course = Course::query()->where('type', 'PAID')->count();
        return array(
            'course' => $course,
            'instructors' => $instructors,
            'free_course' => $free_course,
            'paid_course' => $paid_course
        );
    }


    /**
     * @param Request $request
     * @return array
     */
    private function searchByGroup(Request $request): array
    {
        $user_id = Auth::user()->id ?? null;
        if ($request->type) {
            $course = GroupClass::query()->where('title', 'LIKE', '%' . $request->keyword . '%')->where('type', strtoupper($request->type))->orderBy('id', 'DESC')->paginate(15);
        } else {
            $course = GroupClass::query()->where('title', 'LIKE', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->paginate(15);
        }
        (new CommonHelpers)->moreGroupCourseInformation($course);
        $lang = Category::query()->where('class_name', 'language')->get();

        $free_course = GroupClass::query()->where('type', 'FREE')->count();
        $paid_course = GroupClass::query()->where('type', 'PAID')->count();
        $instructors = $this->getInstructors($user_id);
        return array(
            'group' => $course,
            'lang' => $lang,
            'instructors' => $instructors,
            'free_course' => $free_course,
            'paid_course' => $paid_course
        );

    }

    /**
     * @param $user_id
     * @return Builder[]|Collection
     */
    private function getInstructors($user_id)
    {
        $instructors = User::query()->where(function ($query) use ($user_id) {
            if (!empty($user_id)) {
                $query->where("id", "!=", $user_id);
            }
        })->where('is_admin', 0)->orderBy('id', 'DESC')->limit("5")->get();

        foreach ($instructors as $row) {
            $row["number_of_course"] = Course::query()->where('user_id', $row->id)->count();
        }
        return $instructors;
    }

}
