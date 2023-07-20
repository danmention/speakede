
@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    @php

        use App\Models\Lesson;
    @endphp


    <main id="main-container">


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
                    <div class="block block-rounded">
                        <div class="block-content">
                            <a class="btn btn-lg btn-primary w-100 mb-2" href="{{url('user/course/lesson/add/'.$row->id)}}">Add Lessons</a>
                        </div>
                    </div>
                    <!-- END Subscribe -->

                    <!-- Instructor -->
                    <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-graduation-cap opacity-50"></i>
                                Instructor
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
                            <div class="fw-semibold mb-1">{{\Auth::user()->firstname}}</div>
                            <div class="fs-sm text-muted">Web Designer</div>
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
                        <div class="block-content">
                            <div class="text-warning text-center mb-1">
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                            </div>
                            <div class="fs-sm text-muted text-center mb-3">
                                258 reviews
                            </div>
                            <table class="table table-borderless table-striped">
                                <tbody>
                                <tr>
                                    <td>
                                        <i class="fa fa-fw fa-heart opacity-50 me-2"></i>
                                        <span class="fs-sm">456 Favorites</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fa fa-fw fa-calendar-alt opacity-50 me-2"></i>
                                        <span class="fs-sm">1 week ago</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fa fa-fw fa-tags opacity-50 me-2"></i>
                                        <a class="link-fx fs-sm fw-medium" href="javascript:void(0)">HTML</a>,
                                        <a class="link-fx fs-sm fw-medium" href="javascript:void(0)">CSS</a>,
                                        <a class="link-fx fs-sm fw-medium" href="javascript:void(0)">JavaScript</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Course Info -->
                </div>
                <div class="col-xl-8">
                    <!-- Lessons -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <!-- Introduction -->


                            <?php $x = 1 ?>
                            @foreach($lessons as $row)
                            <table class="table table-borderless table-vcenter mb-4">
                                <tbody>
                                <tr class="table-active">
                                    <th style="width: 50px;"></th>
                                    <th>{{$x++}}. {{$row->lesson_name}}</th>
                                    <th class="fs-sm text-end">
                                        <span class="text-muted">0.5 hours</span>
                                    </th>
                                </tr>

                                @foreach(Lesson::query()->where('group_id', $row->group_id)->get() as $rw)
                                <tr>
                                    <td class="table-success text-center">
                                        <i class="fa fa-fw fa-unlock text-success"></i>
                                    </td>
                                    <td>
                                        <a href="#">{{$rw->lesson_title}}</a>
                                    </td>
                                    <td class="text-end">
                                        30 min
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
