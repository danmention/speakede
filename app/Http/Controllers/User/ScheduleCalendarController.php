<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentType;
use App\Enums\ScheduleTypes;
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\CommunicationPayment;
use App\Models\CoursePayment;
use App\Models\GroupClassEnrollment;
use App\Models\PaymentTransaction;
use App\Models\ScheduleEvent;
use App\Models\User;
use App\Services\zoom\ZoomServiceImpl;
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


    public function getEvent(Request $request)
    {
        if ($request->ajax()) {
            if($request->instructor_user_id){
                $user_id = User::query()->where('identity',$request->instructor_user_id)->value('id');
                $data = ScheduleEvent::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title', 'start', 'end']);
            } else {
                $data = ScheduleEvent::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->where('instructor_user_id', Auth::user()->id)
                    ->get(['id', 'title', 'start', 'end']);
            }

            return response()->json($data);
        }

        return view('user.schedule');
    }

    public function store(Request $request): ?JsonResponse
    {
        switch ($request->type) {
            case 'add':
                $event = new ScheduleEvent();
                $event->title =  $request->title;
                $event->start = $request->start;
                $event->end = $request->end;

                if($request->user_id){
                    $user_id = User::query()->where('identity',$request->user_id )->value('id');
                    $event->instructor_user_id = $user_id;
                    $event->student_user_id = Auth::user()->id;
                    $event->type = ScheduleTypes::BOOKED;
                } else {
                    $event->instructor_user_id =  Auth::user()->id;
                    $event->type = ScheduleTypes::FREE;
                }

                $event->save();

                return response()->json($event);

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


    public function bookingSchedule(Request $request): ?RedirectResponse
    {
       $zoom_response =  $this->zoomServiceImpl->bookMeeting($request);
        $ref = CommonHelpers::code_ref(10);
        switch ($request->type) {
            case 'add':
                $event = new ScheduleEvent();
                $event->title =  "BOOKED";
                $event->start = $request->start;
                $event->end = $request->end;

                $user_id = User::query()->where('identity',$request->identity)->value('id');
                $event->instructor_user_id = $user_id;
                $event->student_user_id = Auth::user()->id;
                $event->type = ScheduleTypes::BOOKED;
                $event->booked_schedule_events_id = $request->id;
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

                $data = new CommunicationPayment();
                $data->user_id = Auth::user()->id;
                $data->instructor_id =  $request->teacher_id;
                $data->schedule_events_id = $request->id;
                $data->reference_no = $ref;
                $data->is_active = "yes";
                $data->save();
                Session::flash('message', "Payment successful");
                return redirect()->route('user.dashboard');
            default:
                break;
        }
        return null;
    }


    public function getScheduleRequest(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = ScheduleEvent::query()->where('student_user_id',$user_id)->orWhere('instructor_user_id', $user_id)
            ->where('status',1)->get();
        foreach ($data as $row){
           $student_user_id = User::query()->where('id',$row->student_user_id)->get();
            $instructor_user_id = User::query()->where('id',$row->student_user_id)->get();
            $row['fullname1'] = $student_user_id[0]->firstname.' '.$student_user_id[0]->lastname;
            $row['fullname2'] = $instructor_user_id[0]->firstname.' '.$instructor_user_id[0]->lastname;
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return view('user.booked-schedule', compact('data'));
    }


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
}