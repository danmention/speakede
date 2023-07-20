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
                    @foreach($course as $row)
                    <div class="col-md-6 col-xl-3">
                        <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success
                        text-center h-100 mb-0" href="{{url('user/course/view/'.$row->url)}}">

                            <br />
                            <iframe width="220" height="150" src="https://www.youtube.com/embed/{{substr($row->youtube_link, strpos($row->youtube_link, "watch?v=") + strlen("watch?v="))}}?rel=0&amp;controls=1&amp&amp;showinfo=0&amp;modestbranding=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                                         encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>


                            <div class="ribbon-box">{{$row->price}}</div>

                            <div class="block-content block-content-full block-content-sm bg-body-light">
                                <div class="fs-sm text-muted">{{Lesson::query()->where('course_id', $row->id)->count()}} lessons</div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="fw-semibold">{{$row->title}}</div>

                                <button type="button" class="btn rounded-pill btn-alt-success me-1 mb-1">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn rounded-pill btn-alt-success me-1 mb-1">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </div>
                        </a>

                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </main>

@endsection
