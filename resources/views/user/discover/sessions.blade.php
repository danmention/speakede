@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    @php
        use Illuminate\Http\Request;
        use App\Models\Lesson;
    @endphp

    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">

            <div class="col-xl-11">

                <h2 class="content-heading d-flex justify-content-between align-items-center">
                    <span>All Online Sessions </span>
                </h2>

                <div class="row">
                    @foreach($sessions as $row)
                        <div class="col-lg-4 col-sm-6" style="margin-bottom: 20px;">
                            <!-- Single Courses Start -->
                            <a href="{{url('online-sessions/'.$row->url)}}">
                                <div class="single-course" style="background-color:#ffffff; padding: 10px;box-shadow: 0 33px 73px 0 rgba(0, 0, 0, 0.1);border-radius: 20px;">
                                    <div class="courses-image" style="background-image: url('{{asset('group/class/photo/'.$row->user_id.'/'.$row->cover_image)}}'); width: 100%; height: 200px; background-size: cover; background-repeat: no-repeat"></div>

                                    <div class="courses-content" style="padding: 10px;overflow: hidden;max-height: 280px !important;">
                                        <span style="color: skyblue; margin-top: 10px;">
                                            {{ \Carbon\Carbon::parse($row->start_date)->format(' H:i')}}  -  {{\Carbon\Carbon::parse($row->start_date)->addMinutes($row->duration_in_mins)->format(' H:i')}}
                                            {{ \Carbon\Carbon::parse($row->start_date)->format('M D Y')}}
                                        </span>
                                        <div style="margin-top: 10px;">
                                            <a href="{{url('online-sessions/'.$row->url)}}">{{ucwords($row->title)}}</a>
                                        </div>
                                        <p>{!! Str::of($row->description)->words(8, ' ....') !!}</p>

                                        <div>
                                        <span class="author-name"><span>Group Class with</span>
                                            <a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}} </a>
                                            <br/>

                                             @if(!empty($row->profile_image))
                                                <div class="figure mb-3">
                                                    <img src="{{asset('profile/photo/'.$row->user_id.'/'.$row->profile_image)}}" style="width: 40px; height: 40px; border-radius: 100%">
                                                </div>
                                            @else
                                                <div class="figure mb-3">
                                                    <img src="{{asset('avater2.png')}}" class="img-avatar" style="width: 40px; height: 40px; border-radius: 100%">
                                                </div>
                                            @endif
                                        </span>
                                            <ul style="list-style: none; padding-left: 0 !important;">
                                                <li style="float: left; margin-right: 10%">
                                                    <b>₦ {{number_format($row->price)}}</b></li>
                                                <li>({{$row->slot}} slot available)</li>
                                            </ul>
                                        </div>
                                        <br /><br /><br />
                                    </div>
                                </div>
                            </a>
                            <!-- Single Courses End -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
