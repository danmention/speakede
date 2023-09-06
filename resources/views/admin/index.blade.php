@extends('admin.template')
@section('content')
@include('admin.layout.side-bar')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <!-- Row #1 -->
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-primary">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-user fa-2x text-white"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold text-white">{{$users}}</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted text-white">Users</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-wallet fa-2x opacity-25"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold">{{$wallet}}</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">Total Wallet</div>
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
