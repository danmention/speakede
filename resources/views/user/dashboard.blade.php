@extends('user.template')
@section('content')
    @include('user.layout.side-bar')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <div class="row">


                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <p class="mb-0">
                        {{ Session::get('message') }}
                    </p>
                </div>
                @endif

                <!-- Row #1 -->
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-shadow text-end" href="{{route('user.dashboard.course')}}">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-book fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">{{$course}}</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">Created Course</div>
                            </div>
                        </div>
                    </a>
                </div>

                    <div class="col-6 col-xl-3">
                        <a class="block block-rounded block-link-shadow text-end" href="{{route('user.dashboard.course')}}">
                            <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                                <div class="d-none d-sm-block">
                                    <i class="fa fa-book fa-2x opacity-25"></i>
                                </div>
                                <div>
                                    <div class="fs-3 fw-semibold">{{$paidCourse}}</div>
                                    <div class="fs-sm fw-semibold text-uppercase text-muted">Paid Course</div>
                                </div>
                            </div>
                        </a>
                    </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-shadow text-end" href="{{route('user.dashboard.wallet')}}">
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


        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
