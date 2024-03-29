@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">

           <h4>( {{ ucwords( \App\Helpers\CommonHelpers::getName(request()->identity))}} )</h4>
            <div class="row">


                <!-- Row #1 -->
                <div class="col-6 col-xl-6">
                    <a class="block block-rounded block-link-shadow text-end" href="#">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-primary">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x text-white"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold text-white">{{$course}}</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted text-white">Created Course</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-xl-6">
                    <a class="block block-rounded block-link-shadow text-end" href="#">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-wallet fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">₦{{number_format($wallet)}}</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">Wallet</div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- END Row #1 -->
            </div>

            <h2 class="content-heading">COURSES</h2>
            <div class="row text-center">
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/course/paid?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-dark">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x text-white"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold text-white">PAID</div>
                                <div
                                    class="fs-sm fw-semibold text-uppercase text-muted text-white">{{$paid_course}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/course?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-primary">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x text-white"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold text-white">CREATED</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted text-white">{{$course}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/course/sold?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-wallet fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">SOLD</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">{{$sold_course}}</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <h2 class="content-heading">GROUP SESSIONS </h2>
            <div class="row text-center">
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/group-session/paid?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">PAID</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">{{$paid_group_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/group-session?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">CREATED</div>
                                <div
                                    class="fs-sm fw-semibold text-uppercase text-muted">{{$created_group_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/group-session/sold?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-wallet fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">SOLD</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">{{$sold_group_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <h2 class="content-heading">PRIVATE SESSIONS </h2>
            <div class="row text-center">
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/private-session/paid?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">PAID</div>
                                <div
                                    class="fs-sm fw-semibold text-uppercase text-muted">{{$paid_private_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/private-session?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">CREATED</div>
                                <div
                                    class="fs-sm fw-semibold text-uppercase text-muted ">{{$created_private_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end"
                       href="{{url('admin/secure/user/dashboard/private-session/sold?identity='.request()->identity)}}">
                        <div
                            class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-wallet fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">SOLD</div>
                                <div
                                    class="fs-sm fw-semibold text-uppercase text-muted">{{$sold_private_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
