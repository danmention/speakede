<?php


namespace App\Helpers;


use App\Models\CustomerRating;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CommonHelpers
{


    /**
     * @param $title
     * @param string $separator
     * @param string $language
     * @return string
     */
    public static function str_slug($title, string $separator = '-', string $language = 'en') : string
    {
        return Str::slug($title, $separator, $language);
    }

    /**
     * @param $string
     * @param $table
     * @param $field
     * @param $key
     * @param $value
     * @return array|string|string[]|null
     */
    public static function create_unique_slug($string, $table,$field,$key=NULL,$value=NULL)
    {

        $slug = strtolower(self::str_slug($string));
        $i = 0;
        $params = array ();
        $params[$field] = $slug;
        if($key)$params["$key !="] = $value;

        while (DB::table($table)->where($params)->count()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params [$field] = $slug;
        }
        return $slug;

    }

    /**
     * @param $type
     * @return string
     */
    public static function generateCramp($type) :string
    {
        $mt = explode(' ', microtime());
        $rand = time() . rand(10, 99);
        $time = ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));
        $generated = $rand . $time;

        switch ($type) {
            case "comments" :
                return "3060" . $generated;
            case "payment" :
                return "3061" . $generated;
            case "user" :
                return "3062" . $generated;
            default:
                return "3069" . $generated;
        }
    }


    /**
     * @param $l
     * @param string $c
     * @return string
     */
    public static function code_ref ($l, string $c = '1234567890') : string {
        for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
        return $s;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function valid_email($email): bool
    {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $phone
     * @return bool
     */
    public static  function validate_phone_number($phone): bool
    {
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace("-", "", $filtered_phone_number);
        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } else {
            return true;
        }
    }


    public static function toZoomTimeFormat(string $dateTime): string
    {
        try {
            $date = new \DateTime($dateTime);
            return $date->format('Y-m-d\TH:i:s');
        } catch(\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());
            return '';
        }
    }

    public static function toUnixTimeStamp(string $dateTime, string $timezone)
    {
        try {
            $date = new \DateTime($dateTime, new \DateTimeZone($timezone));
            return $date->getTimestamp();
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toUnixTimeStamp : ' . $e->getMessage());
            return '';
        }
    }

    public static function minsToHours($minutes): string
    {
        $hours = floor($minutes / 60);
        $min = $minutes - ($hours * 60);
        return $hours."h, ".$min." m";
    }

    /**
     * @param $date_from
     * @param $date_to
     * @return int
     */
    public function getCourseTimeDuration($date_from, $date_to): int
    {
        $to = Carbon::createFromFormat('Y-m-d H:s:i', $date_to);
        $from = Carbon::createFromFormat('Y-m-d H:s:i', $date_from);

        return $to->diffInMinutes($from);
    }

    /**
     * @param $request
     * @return CustomerRating
     */
    public static function StoreReviews($request) : CustomerRating {

        $data = new CustomerRating();
        $data->fullname = $request->fullname;
        $data->email    = $request->email;
        $data->review   = $request->review;
        $data->user_id  = $request->user_id ?? null;
        $data->instructor_id = $request->instructor_id ?? null;
        $data->course_id = $request->course_id;
        $data->rating   = $request->rating ?? 5;
        $data->save();
        return $data;
    }


    /**
     * @param $user_id
     * @return float|int
     */
    public function rating($user_id){
        $numbers_of_rating =  CustomerRating::where('user_id',$user_id)->sum('rating');
        $number_of_people_rating = CustomerRating::where('user_id',$user_id)->count();

        if($number_of_people_rating == 0){
            $final_rating = 0;
        }else {
            $final_rating = $numbers_of_rating / $number_of_people_rating;
        }
        return $final_rating;
    }



    /**
     * @param $course
     * @return void
     */
    public function moreGroupCourseInformation($course): void
    {
        foreach ($course as $row) {
            $user = User::query()->where('id', $row->user_id)->get();
            $row["firstname"] = $user[0]->firstname;
            $row["lastname"] = $user[0]->lastname;
            $row["identity"] = $user[0]->identity;
            $row["profile_image"] = $user[0]->profile_image;
        }
    }

    /**
     * @param $course
     * @return void
     */
    public function moreCourseInformation($course): void
    {
        foreach ($course as $row) {
            $user = User::query()->where('id', $row->user_id)->get();
            $row["firstname"] = $user[0]->firstname;
            $row["lastname"] = $user[0]->lastname;
            $row["identity"] = $user[0]->identity;

            $lesson = Lesson::query()->where('course_id', $row->id)->get();
            $course_duration = 0;
            foreach ($lesson as $rw) {
                $course_duration = +(new CommonHelpers)->getCourseTimeDuration($rw->start_time, $rw->end_time);
            }

            $row['course_duration'] = CommonHelpers::minsToHours($course_duration);
            $row['rating'] = CustomerRating::where('course_id', $row->id)->count();
        }
    }

}
