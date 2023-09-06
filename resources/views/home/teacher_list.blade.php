<!-- Course List Start -->
<div class="single-course-list">
    <div class="course-image">

        @if(!empty($row->profile_image))
            <a href="{{url('teacher/'.$row->identity)}}"> <img src="{{asset('profile/photo/'.$row->id.'/'.$row->profile_image)}}" class="img-avatar" alt="author" style="width: 80px"></a>
        @else
            <a href="{{url('teacher/'.$row->identity)}}"> <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author" style="width: 80px"></a>
        @endif
    </div>
    <div class="course-content">
        <div style="margin-bottom: 10px">
            <h3 class="title"><a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}}</a></h3>
            <span class="author-name">TUTOR</span>
        </div>

        <div class="top-meta">
            <a class="tag" href="#">TUTORS:</a>
            @foreach($row["preferred_lang"] as $rw)
                <span class="language">{{$rw->title}}</span>
            @endforeach

        </div>

        <br />
        <div class="top-meta">
            <a class="tag" href="#">SPEAKS:</a>
            @foreach($row["language_i_speak"] as $rw)
                <span class="language">{{$rw->title}}</span>
            @endforeach

        </div>

        <p>{!! $row->about_me !!}</p>
        <div class="bottom-meta">
            <div class="rating">
                <div class="rating-star">
                    <div class="rating-active" style="width: {{$row->rating}}%;"></div>
                </div>
                <span>({{$row->rating}})</span>
            </div>
        </div>
    </div>
</div>
<!-- Course List End -->
