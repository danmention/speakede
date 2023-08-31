<!-- Single Courses Start -->
<div class="single-course">
    <div class="courses-image">
        <img src="{{asset('course/photo/'.$row->user_id.'/'.$row->cover_image)}}" width="310" height="218" >
    </div>
    <div class="courses-content">
        <div class="top-meta">
            <div class="tag-time">
                <a class="tag" href="{{url('course/'.$row->url)}}" style="color: black;">{{ucwords($row->title)}}</a>
                <p class="time"><i class="far fa-clock"></i>{{$row->course_duration}}</p>
            </div>
            <span class="price">
                <span class="sale-price">{{$row->type}}</span>
            </span>
        </div>
        <h3 class="title"><a href="{{url('course/'.$row->url)}}">{{ucwords($row->title)}}</a></h3>
        <div class="courses-meta">
            <p class="author-name"><span>By</span>
                <a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}} </a></p>
            <div class="rating">
                <div class="rating-star">
                    <div class="rating-active" style="width: {{$row->rating}}%;"></div>
                </div>
                <span>({{$row->rating}})</span>
            </div>
        </div>
    </div>
</div>
<!-- Single Courses End -->
