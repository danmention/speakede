@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">

                <div class="col-md-6 col-xl-5">
                    <!-- Detailed Project 1 -->
                    <div class="block block-rounded h-100 mb-0">

                        <div class="block-content block-content-full bg-body-light text-center">
                            <h4 class="fs-sm text-muted mb-0">Private Online Meeting (ZOOM)</h4>
                        </div>
                        <div class="block-content text-center">
                            <h3>₦ {{number_format($schedule_info[0]->price)}}</h3>
                            <p>Available : ₦{{number_format($wallet)}}</p>
                            <h4>Instructor: {{$instructor[0]->firstname. ' '.$instructor[0]->lastname}}</h4>
                            <h4> Language: {{ucwords($preferred_lang[0]->title)}}</h4>
                            <h4>Start Time : {{$schedule_info[0]->start}}</h4>
                            <h4>End Time: {{$schedule_info[0]->end}}</h4>

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
                                        <form role="form" method="post" class="validate" action="{{ route('user.schedule.booking') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="teacher_id" value="{{$instructor[0]->id}}">
                                            <input type="hidden" name="id" value="{{$id}}">
                                            <input type="hidden" name="title" value="Online Meeting">
                                            <input type="hidden" name="type" value="add">
                                            <input type="hidden" name="start" value="{{$schedule_info[0]->start}}">
                                            <input type="hidden" name="end" value="{{$schedule_info[0]->end}}">
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
