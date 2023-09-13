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
                                <h2 class="title">Register</h2>
                            </div>
                            <!-- Section Title End -->

                            <div class="login-register-form">
                                <form method="post" action="{{route('index.register.save')}}" enctype="multipart/form-data"  role="form">
                                {{ csrf_field() }}


                                @if(session('error'))
                                    <div class="notification-alert-danger alert alert-danger alert-dismissible fade show" role="alert">
                                        {{session('error')}}
                                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif

                                    @if(Session::has('message'))
                                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                                    @endif

                                    <div class="error-message">
                                        <div>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="single-form">
                                        <input type="text" class="form-control" placeholder="Firstname" name="firstname">
                                    </div>

                                    <div class="single-form">
                                        <input type="text" class="form-control" placeholder="Lastname" name="lastname">
                                    </div>

                                    <div class="single-form">
                                        <input type="email" class="form-control" placeholder="Email " name="options">
                                    </div>

                                    <div class="single-form">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>

                                    <div class="single-form">
                                        <input type="password" name="password_confirmation" placeholder="Retype Password" required="true" class="form-control">
                                    </div>
                                    <div class="single-form form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                    </div>
                                    <div class="form-btn">
                                        <button class="btn">Register</button>
                                    </div>
                                    <div class="single-form">
                                        <p><a href="#">Lost your password?</a></p>
                                    </div>

                                    <a href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #C84130;color: #ffffff;padding: 8px;border-radius:6px;" class="ml-2">
                                        <strong>Register with Google</strong>
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
