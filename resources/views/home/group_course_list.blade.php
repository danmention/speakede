<!-- Single Courses Start -->
<a href="{{url('group/online/class/'.$row->url)}}">
    <div class="single-course" style="background-color:#ffffff; padding: 10px;box-shadow: 0 33px 73px 0 rgba(0, 0, 0, 0.1);border-radius: 20px;">
    <div class="courses-image" style="max-width: 300px; max-height: 200px;">
        <img src="{{asset('group/class/photo/'.$row->user_id.'/'.$row->cover_image)}}" class="img-avatar" style="width: 100%; height: 200px; background-repeat: no-repeat;background-size: contain;">
    </div>
    <div class="courses-content">
        <p style="color: skyblue">
            {{ \Carbon\Carbon::parse($row->start_date)->format(' H:i')}}  -  {{\Carbon\Carbon::parse($row->start_date)->addMinutes($row->duration_in_mins)->format(' H:i')}} {{ \Carbon\Carbon::parse($row->start_date)->format('M D Y')}}</p>
        <div style="margin-bottom: 10px;">
            <h2 class="title">
                <a href="{{url('group/online/class/'.$row->url)}}">{{ucwords($row->title)}}</a>
            </h2>

        </div>

        <div>
            <span class="author-name"><span>Group Class with</span>
                <a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}} </a>
                <br />

                 @if(!empty($row->profile_image))
                    <div class="figure mb-3">
                        <img
                            src="{{asset('profile/photo/'.$row->user_id.'/'.$row->profile_image)}}" class="img-avatar" alt="author" style="width: 30px">
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
    </div>
</div>
</a>
<!-- Single Courses End -->
