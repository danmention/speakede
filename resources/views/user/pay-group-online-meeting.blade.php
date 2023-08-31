@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


    <main>
        <div class="content">

            <div class="col-md-6 col-xl-5">
                <!-- Detailed Project 1 -->
                <div class="block block-rounded h-100 mb-0">

                    <div class="block-content block-content-full bg-body-light text-center">
                        <h4 class="fs-sm text-muted mb-0">Group Online Meeting (ZOOM)</h4>
                    </div>
                    <div class="block-content text-center">
                        <h3>₦ {{number_format($schedule_info[0]->price)}}</h3>
                        <p>Available : ₦{{number_format($wallet)}}</p>
                        <h4>Instructor: {{$instructor[0]->firstname. ' '.$instructor[0]->lastname}}</h4>
                        <h4> Language: {{ucwords($schedule_info[0]->title)}}</h4>
                        <h4>Start Time : {{$schedule_info[0]->start_date}}</h4>
                        <h4>Duration: {{$schedule_info[0]->duration_in_mins}} mins</h4>

                    </div>
                    <div class="block-content block-content-full">
                        <div class="row g-sm">

                            @if($schedule_info[0]->price > $wallet)
                                <div class="col-6">
                                    <a class="btn w-100 btn-alt-secondary" href="{{route('user.dashboard.wallet')}}">
                                        <i class="fa fa-archive me-1 text-muted"></i> Fund wallet
                                    </a>
                                </div>
                            @else
                                <div class="col-6">
                                    <form role="form" method="post" class="validate" action="{{ route('user.group.schedule.booking') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="teacher_id" value="{{$teacher_id}}">
                                        <input type="hidden" name="title" value="Group Online Meeting">
                                        <input type="hidden" name="type" value="add">
                                        <input type="hidden" name="start" value="{{$schedule_info[0]->start_date}}">
                                        <input type="hidden" name="group_class_id" value="{{$slot_id}}">
                                        <input type="hidden" name="amount" value="{{$schedule_info[0]->price}}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus opacity-50 me-1"></i> Pay Now
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- END Detailed Project 1 -->
            </div>
        </div>
    </main>
@endsection
