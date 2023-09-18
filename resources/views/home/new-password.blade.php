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
                                <h2 class="title">New Password</h2>
                            </div>
                            <!-- Section Title End -->

                            <div class="login-register-form">
                                <form action="{{ route('password.verify.save') }}" method="post" class="js-validation-signin">
                                    {{ csrf_field() }}


                                    @if(session('error'))

                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style=""></button>
                                            {{ session('error') }}
                                        </div>

                                    @endif


                                    @if(session('response'))

                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style=""></button>
                                            {{ session('response') }}
                                        </div>

                                    @endif


                                    <div class="single-form">
                                        <input type="text" name="verify_code" class="form-control" placeholder="Verify Code" required="required">
                                    </div>

                                    <div class="single-form">
                                        <input type="password" class="form-control" placeholder="New Password" name="password">
                                        @if ($errors->has('password'))
                                            <div class="alert alert-info">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="single-form">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="alert alert-info">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-btn">
                                        <button class="btn">Submit</button>
                                    </div>

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
