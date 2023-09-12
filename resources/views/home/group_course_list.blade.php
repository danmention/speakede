<!-- Single Courses Start -->

<div style="background-color:#ffffff;box-shadow: 0 33px 73px 0 rgba(0, 0, 0, 0.1);border-radius: 20px; margin-bottom: 20px;">
    <div class="courses-image" style="background-image: url('{{asset('group/class/photo/'.$row->user_id.'/'.$row->cover_image)}}');
    width: 100%; height: 218px; background-size: cover; background-repeat: no-repeat;border-top-left-radius: 20px;border-top-right-radius: 20px;"></div>
    <div class="courses-content" style="padding: 10px;overflow: hidden;max-height: 280px !important;">
        <p style="color: skyblue">
            {{ \Carbon\Carbon::parse($row->start_date)->format(' H:i')}}
            - {{\Carbon\Carbon::parse($row->start_date)->addMinutes($row->duration_in_mins)->format(' H:i')}} {{ \Carbon\Carbon::parse($row->start_date)->format('M D Y')}}</p>
        <div style="margin-bottom: 10px;">
            <h2 class="title" style="font-size: 20px;">
                <a href="{{url('online-sessions/'.$row->url)}}">{{ucwords($row->title)}}</a>
            </h2>
            <p>{!! Str::of($row->description)->words(8, ' ....') !!}</p>

        </div>

        <div>
                <span class="author-name"><span>Group Class with</span>
                    <a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}} </a>
                    <br/>

                     @if(!empty($row->profile_image))
                        <div class="figure mb-3">
                            <img
                                src="{{asset('profile/photo/'.$row->user_id.'/'.$row->profile_image)}}" class="img-avatar"
                                alt="author" style="width: 30px">
                        </div>
                    @else
                        <div class="figure mb-3">
                            <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author" style="width: 30px">
                        </div>
                    @endif
                </span>
            <ul>
                <li style="float: left; margin-right: 30%"><b>₦ {{number_format($row->price)}}</b></li>
                <li>({{$row->slot}} slot available)</li>
            </ul>
        </div>
        <br /><br /><br />
    </div>
</div>

<!-- Single Courses End -->
