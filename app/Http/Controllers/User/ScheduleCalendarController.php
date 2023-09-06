<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentType;
use App\Enums\ScheduleTypes;
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\CommunicationPayment;
use App\Models\GroupClassEnrollment;
use App\Models\PaymentTransaction;
use App\Models\PreferredLanguage;
use App\Models\Schedule;
use App\Models\ScheduleEvent;
use App\Models\User;
use App\Services\zoom\ZoomServiceImpl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ScheduleCalendarController extends Controller
{

    private $zoomServiceImpl;

    /**
     * @param ZoomServiceImpl $zoomServiceImpl
     */
    public function __construct(ZoomServiceImpl $zoomServiceImpl)
    {
        $this->zoomServiceImpl = $zoomServiceImpl;
    }


    /**
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     */
    public function getEvent(Request $request)
    {
        if ($request->ajax()) {
            $data = ScheduleEvent::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->where('user_id', Auth::user()->id)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('user.schedule');
    }


    /**
     * @return Application|Factory|View
     */
    public function getAllSchedule(){
        $schedule = ScheduleEvent::query()->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('user.schedule-all', compact('schedule'));
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getCreateScheduleEvent(Request $request)
    {
        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id', Auth::user()->id)->get(['categories.*']);
        return view('user.set-availability', compact('preferred_lang'));
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|null
     */
    public function store(Request $request)
    {
        switch ($request->type) {
            case 'add':
                $event = new ScheduleEvent();
                $event->title =  $request->title;
                $event->start = $request->start;
                $event->end = $request->end;
                $event->price = $request->price;
                $event->description = $request->description;
                $event->user_id = Auth::user()->id;
                $event->type = $request->schedule_type;
                $event->language_id = $request->language_id;
                $event->status = 1;
                $event->save();
                Session::flash('message', "Schedule Created successful");
                return redirect()->route('user.dashboard');

            case 'update':
                $event = ScheduleEvent::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);

            case 'delete':
                $event = ScheduleEvent::find($request->id)->delete();
                return response()->json($event);

            default:
                break;
        }
        return null;
    }


    /**
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function bookingSchedule(Request $request): ?RedirectResponse
    {
       $zoom_response =  $this->zoomServiceImpl->bookMeeting($request);
        $ref = CommonHelpers::code_ref(10);
        switch ($request->type) {
            case 'add':
                $event = new Schedule();
                $event->title =  "BOOKED";
                $event->start = $request->start;
                $event->end = $request->end;

                $user_id = User::query()->where('identity',$request->identity)->value('id');
                $event->instructor_user_id = $user_id;
                $event->initiate_user_id = Auth::user()->id;
                $event->type = ScheduleTypes::BOOKED;
                $event->schedule_events_id = $request->id;
                $event->status = 1;
                $event->zoom_response = json_encode($zoom_response);
                $event->save();


                $data = new PaymentTransaction();
                $data->user_id = Auth::user()->id;
                $data->amount =  $request->amount;
                $data->ref_no = $ref;
                $data->description = "Payment for zoom online meeting";
                $data->extra = null;
                $data->type = PaymentType::DEBIT;
                $data->status = 1;
                $data->save();

                Session::flash('message', "Payment successful");
                return redirect()->route('user.dashboard.discover.tutors');
            default:
                break;
        }
        return null;
    }


    /**
     * @return Application|Factory|View
     */
    public function getPaidPrivateMeeting()
    {
        $user_id = Auth::user()->id;
        $data = Schedule::query()->where('initiate_user_id',$user_id)->where('instructor_user_id', '!=', $user_id)->where('status',1)->get();
        return $this->privateMeetingInfo($data);
    }

    /**
     * @return Application|Factory|View
     */
    public function getSoldPrivateMeeting()
    {
        $user_id = Auth::user()->id;
        $data = Schedule::query()->where('instructor_user_id',$user_id)->where('initiate_user_id', '!=', $user_id)->where('status',1)->get();
        return $this->privateMeetingInfo($data);
    }


    /**
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function bookingGroupSchedule(Request $request): ?RedirectResponse
    {
        $ref = CommonHelpers::code_ref(10);
        switch ($request->type) {
            case 'add':
                $event = new GroupClassEnrollment();
                $event->instructor_id = $request->teacher_id;
                $event->user_id = Auth::user()->id;
                $event->reference_no = $ref;
                $event->group_class_id = $request->group_class_id;
                $event->status = 1;
                $event->save();

                $data = new PaymentTransaction();
                $data->user_id = Auth::user()->id;
                $data->amount =  $request->amount;
                $data->ref_no = $ref;
                $data->description = "Payment for Group zoom online meeting";
                $data->extra = null;
                $data->type = PaymentType::DEBIT;
                $data->status = 1;
                $data->save();

                Session::flash('message', "Payment successful");
                return redirect()->route('user.dashboard');
            default:
                break;
        }
        return null;
    }

    /**
     * @param $data
     * @return Application|Factory|View
     */
    private function privateMeetingInfo($data)
    {
        foreach ($data as $row) {
            $instructor = User::query()->where('id', $row->instructor_user_id)->get();
            $row['student'] = $instructor[0]->firstname . ' ' . $instructor[0]->lastname;
            $row["instructor"] = Auth::user()->firstname . ' ' . Auth::user()->lastname;
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return view('user.booked-schedule', compact('data'));
    }
}
