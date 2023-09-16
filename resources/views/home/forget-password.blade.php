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
                                <h2 class="title">Forget Password</h2>
                            </div>
                            <!-- Section Title End -->

                            <div class="login-register-form">
                                <form action="{{ route('forget.password.reset') }}" method="post" class="js-validation-signin">
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

                                    @if(session('responses'))
                                        <div class="notification-alert alert alert-success alert-dismissible fade show" role="alert">
                                            {{session('responses')}}
                                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="single-form">
                                        <input type="text" class="form-control" placeholder="Email" name="email">
                                        @if ($errors->has('email'))
                                            <div class="alert alert-info">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-btn">
                                        <button class="btn">Find</button>
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
