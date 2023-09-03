@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">

            <div class="row">

                <!-- Row #1 -->
                <div class="col-6 col-xl-6">
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-secondary">
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
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
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
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-secondary">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x text-white"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold text-white">PAID</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted text-white">{{$paid_course}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-info">
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
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
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
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
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
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">CREATED</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">{{$created_group_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
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
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">PAID</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">{{$paid_private_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">CREATED</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted ">{{$created_private_sessions}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-4">
                    <a class="block block-rounded block-link-shadow text-end" href="{{url('')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-wallet fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">SOLD</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">{{$sold_private_sessions}}</div>
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
