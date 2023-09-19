@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')


    <main>

        <div class="content">

            <div class="col-xl-11">


                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Change Password</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                    <!--end breadcrumb-->

                        @if(session('success'))

                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <h3 class="alert-heading fs-5 fw-bold mb-1">Success</h3>
                                <p class="mb-0">
                                    {{session('success')}}
                                </p>
                            </div>
                        @endif


                        @if(session('error'))

                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <h3 class="alert-heading fs-5 fw-bold mb-1">Success</h3>
                                <p class="mb-0">
                                    {{session('error')}}
                                </p>
                            </div>
                        @endif


                            <div class="box-content">
                                <form role="form" method="post" class="validate" action="{{ route('admin.user.password.save') }}">
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" name="current_password" required>
                                                @if ($errors->has('current_password'))
                                                    <div class="alert alert-info">
                                                        <strong>{{ $errors->first('current_password') }}</strong>
                                                    </div>
                                                @endif
                                                <label class="form-label">Old Password</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" name="new_password" required>
                                                @if ($errors->has('new_password'))
                                                    <div class="alert alert-info">
                                                        <strong>{{ $errors->first('new_password') }}</strong>
                                                    </div>
                                                @endif
                                                <label class="form-label">New Password</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">

                                                <input type="password" class="form-control" name="confirm_new_password" required>
                                                @if ($errors->has('confirm_new_password'))
                                                    <div class="alert alert-info">
                                                        <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                                    </div>
                                                @endif
                                                <label class="form-label">New Password Repeat</label>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-plus opacity-50 me-1"></i>  Change Password
                                            </button>
                                        </div>

                                    </div>

                                </form>


                    </div>
                    <!--/span-->

            </div>
            <!--/row-->
                </div>
            </div>
        </div>
    </main>
        @endsection
