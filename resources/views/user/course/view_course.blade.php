
@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    @php

        use App\Models\Lesson;
    @endphp


    <main id="main-container">

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif


        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session('error') }}
            </div>
        @endif


        @foreach($course as $row)
        <!-- Page Content -->
        <div class="content">
            <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
                <a class="breadcrumb-item" href="#">Courses</a>
                <span class="breadcrumb-item active">{{$row->title}}</span>


            </nav>
            <div class="row">
                <div class="col-xl-4">
                    <!-- Subscribe -->

                    @if($iAddedThisCourse)
                    <div class="block block-rounded">
                        <div class="block-content">
                            <a class="btn btn-lg btn-primary w-100 mb-2" href="{{url('user/course/lesson/add/'.$row->id)}}">Add Lessons</a>
                        </div>
                    </div>
                    @endif
                    <!-- END Subscribe -->

                    <!-- Instructor -->
                    <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-graduation-cap opacity-50"></i>
                                Tutor
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="push">

                                @if(!empty(Auth::user()->profile_image))
                                    <div class="figure mb-3">
                                        <img src="{{asset('profile/photo/'.Auth::user()->id.'/'.Auth::user()->profile_image)}}" class="img-avatar img-avatar32"" alt="image">
                                    </div>
                                @else
                                    <div class="figure mb-3">
                                        <img src="{{asset('avater2.png')}}" class="img-avatar" alt="image">
                                    </div>
                                @endif

                            </div>
                            <div class="fw-semibold mb-1">{{$row->fullname}}</div>
                        </div>
                    </a>
                    <!-- END Instructor -->

                    <!-- Course Info -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default text-center">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-info opacity-50"></i>
                                About
                            </h3>
                        </div>
                        <div style="padding: 10px;">
                            <p> {!! $row->about_me !!}</p>
                        </div>
                    </div>
                    <!-- END Course Info -->
                </div>
                <div class="col-xl-8">
                    <!-- Lessons -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <!-- Introduction -->


                            @if($lessons->count() == 0)
                                <h3> No Lesson yet!</h3>
                            @endif
                            <?php $x = 1 ?>
                            @foreach($lessons as $lesson)
                            <table class="table table-borderless table-vcenter mb-4">
                                <tbody>
                                <tr class="table-active">
                                    <th style="width: 50px;"></th>
                                    <th>{{$x++}}. {{$lesson->lesson_name}}</th>
                                    <th class="fs-sm text-end">
                                    </th>
                                </tr>

                                @foreach(Lesson::query()->where('group_id', $lesson->group_id)->get() as $rw)
                                <tr>
                                    <td class="table-success text-center">
                                        <i class="fa fa-fw {{($canWatch ? "fa-unlock" : "fa-lock")}} text-success"></i>
                                    </td>
                                    <td>
                                        <a href="{{($canWatch ? url('user/course/view/'.$row->url.'/'.$rw->url) : "#")}}">{{$rw->lesson_title}}</a>
                                    </td>
                                    <td class="text-end">
                                        {{$lesson->course_duration}}

                                        @if($iAddedThisCourse)
                                            <a href="{{(url('user/course/lesson/edit?url='.$lesson->url))}}" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" >
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{route('user.course.lesson.delete')}}" method="POST" style="float: right; margin-left: 10px;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                                <button type="submit" class="btn btn-sm btn-secondary"  onclick="if (!confirm('Are you sure?')) { return false }">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endforeach
                            <!-- END Introduction -->
                        </div>
                    </div>
                    <!-- END Lessons -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
        @endforeach
    </main>

@endsection
