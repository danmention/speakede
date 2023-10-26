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
                        <span>
                            @if(request()->segment(2) === "course" && request()->segment(3) === "paid")
                           All Paid Courses
                            @elseif(request()->segment(2) === "course" && request()->segment(3) === "sold")
                               All Sold Courses
                            @elseif(request()->segment(3) === "theme")
                                All Theme Courses
                            @elseif(request()->segment(3) === "type" && request()->segment(2) != "discover")
                                All {{ucwords(request()->segment(4))}} Courses

                            @elseif(request()->segment(2) === "course" && request()->segment(3) === "all")
                                All Created Courses
                            @else
                            All Courses
                            @endif
                        </span>
                </h2>

                <div class="row items-push">

                    @if($course->count() == 0)
                        <div class="col-md-6 col-xl-5">
                            <!-- Detailed Project 1 -->
                            <div class="block block-rounded h-100 mb-0">

                                <div class="block-content text-center">
                                   <h3>No Course yet!</h3>
                                </div>
                            </div>
                            <!-- END Detailed Project 1 -->
                        </div>
                    @endif
                    @foreach($course as $row)
                    <div class="col-md-6 col-xl-3">
                        @if($row->payed_user_id == auth()->user()->id)
                        <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success text-center h-100 mb-0" href="{{url('user/course/view/'.$row->url)}}">
                            @elseif($row->user_id == auth()->user()->id)
                                <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success text-center h-100 mb-0" href="{{url('user/course/view/'.$row->url)}}">
                                    @else
                                    <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success text-center h-100 mb-0" href="{{url('course/'.$row->url)}}">
                            @endif

                            <div class="courses-image" style="background-image: url('{{asset('course/photo/'.$row->user_id.'/'.$row->cover_image)}}');
                             width: 100%; height: 200px; background-size: cover; background-repeat: no-repeat;border-radius: 0.875rem 0.875rem 0 0"></div>

                            <div class="ribbon-box">{{$row->price}}</div>

                            <div class="block-content block-content-full block-content-sm bg-body-light">
                                <div class="fs-sm text-muted">{{Lesson::query()->where('course_id', $row->id)->count()}} lessons</div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="fw-semibold">{{$row->title}}</div>

                                @if($row->user_id == auth()->user()->id)
                                    <ul style="list-style: none; margin-left: 40px;">
                                        <li style="float: left">
                                        <form action="{{route('user.course.delete.now')}}" method="POST" style="position: center;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="course_id" value="{{$row->id}}">
                                                <button type="submit" class="btn btn-sm btn-secondary"  onclick="if (!confirm('Are you sure you want to delete, this will also delete all lessons under this course?')) { return false }">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                    @endif

                            </div>
                        </a>

                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </main>

@endsection
