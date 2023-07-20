
@extends('admin.template')
@section('content')
<div id="page-container" class="main-content-boxed">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-body-dark">
            <div class="row mx-0 justify-content-center">
                <div class="hero-static col-lg-6 col-xl-4">
                    <div class="content content-full overflow-hidden">
                        <!-- Header -->
                        <div class="py-4 text-center">
                            <a class="link-fx fw-bold" href="{{route('admin.home')}}">
{{--                                <i class="fa fa-fire"></i>--}}
{{--                                <span class="fs-4 text-body-color">code</span><span class="fs-4">base</span>--}}
                            </a>
                            <h1 class="h3 fw-bold mt-4 mb-2">Welcome to Your Dashboard</h1>
                            <h2 class="h5 fw-medium text-muted mb-0">It’s a great day today!</h2>
                        </div>
                        <!-- END Header -->

                        <form action="{{ route('login.in.user') }}" method="post" class="js-validation-signin">
                            {{ csrf_field() }}

                            @if(session('error'))
                                <div class="notification-alert-danger alert alert-danger alert-dismissible fade show" role="alert">
                                    {{session('error')}}
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif


                            @if(session('response'))

                                <div class="notification-alert alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('response')}}
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif

                            <div class="block block-themed block-rounded block-fx-shadow">
                                <div class="block-header bg-gd-dusk">
                                    <h3 class="block-title">Please Sign In</h3>
                                </div>
                                <div class="block-content">
                                    <div class="form-floating mb-4">

                                        <input type="text" name="options" class="form-control" placeholder="Email or Phone" >
                                        <label class="form-label" for="login-username">Email or Phone</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                        <label class="form-label" for="password">Password</label>

                                        @if ($errors->has('password'))
                                            <div class="alert alert-info">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 d-sm-flex align-items-center push">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="login-remember-me" name="login-remember-me">
                                                <label class="form-check-label" for="login-remember-me">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-sm-end push">
                                            <button type="submit" class="btn btn-lg btn-alt-primary fw-medium">
                                                Sign In
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content block-content-full bg-body-light text-center d-flex justify-content-between">
                                    <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" href="{{route('account.forget.pass')}}">
                                        Forgot Password
                                    </a>
                                </div>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->
@endsection
