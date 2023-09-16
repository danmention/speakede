@extends('home.template')
@section('content')
    <br />
    <br />

    <!-- Login & Register Start -->
    <div class="section login-register-section section-padding">
        <div class="container">

            <!-- Login & Register Wrapper Start -->
            <div class="login-register-wrap">
                <div class="row  d-flex align-items-center justify-content-center">
                    <div class="col-lg-6">

                        <!-- Login & Register Box Start -->
                        <div class="login-register-box">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="title">Login</h2>
                            </div>
                            <!-- Section Title End -->

                            <div class="login-register-form">
                                <form action="{{ route('login.in.user') }}" method="post" class="js-validation-signin">
                                    {{ csrf_field() }}


                                    @if(Session::has('message'))
                                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                                    @endif


                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if (session('response'))
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            {{ session('response') }}
                                        </div>
                                    @endif

                                    <div class="single-form">
                                        <input type="text" class="form-control" placeholder="Email or Phone" name="options">
                                    </div>
                                    <div class="single-form">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <div class="single-form form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                    </div>
                                    <div class="form-btn">
                                        <button class="btn">Login</button>
                                    </div>

                                    <div class="single-form">
                                        <p><a href="{{route('account.forget.pass')}}">Lost your password?</a></p>
                                    </div>

                                    <br />

                                    <a href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #C84130;color: #ffffff;padding: 8px;border-radius:6px;" class="ml-2">
                                        <strong>Login with Google</strong>
                                    </a>
                                </form>
                            </div>
                        </div>
                        <!-- Login & Register Box End -->

                    </div>

                </div>
            </div>
            <!-- Login & Register Wrapper End -->

        </div>
    </div>
    <!-- Login & Register End -->

@endsection
