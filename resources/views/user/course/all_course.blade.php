@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    @php
        use Illuminate\Http\Request;
        use App\Models\Lesson;
    @endphp

    <main>
        <div class="content">

            <div class="col-xl-11">

                <h2 class="content-heading d-flex justify-content-between align-items-center">
                        <span>
                          <i class="fa fa-fw fa-star opacity-50 me-1"></i> All Courses
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
                        <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success
                        text-center h-100 mb-0" href="{{url('user/course/view/'.$row->url)}}">

                            <br />
                            <img src="{{asset('course/photo/'.$row->user_id.'/'.$row->cover_image)}}" width="220" height="150" >


                            <div class="ribbon-box">{{$row->price}}</div>

                            <div class="block-content block-content-full block-content-sm bg-body-light">
                                <div class="fs-sm text-muted">{{Lesson::query()->where('course_id', $row->id)->count()}} lessons</div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="fw-semibold">{{$row->title}}</div>
                            </div>
                        </a>

                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </main>

@endsection
