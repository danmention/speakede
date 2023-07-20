@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')


    <div class="page-wrapper">
        <!--page-content-wrapper-->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                    <div class="breadcrumb-title pr-3">Forms</div>
                    <div class="pl-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Elements</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <!--end breadcrumb-->
                <div class="card radius-15">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                {{ session('success') }}
                            </div>
                        @endif


                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session('error') }}
                        </div>
                    @endif



                        <div class="box-header well" data-original-title="">
                            <h2><i class="glyphicon glyphicon-plus"></i> Change Password  </h2>

                        </div>
                        <div class="box-content">
                            <form role="form" method="post" class="validate" action="{{ route('admin.user.password.save') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}


                                <div class="card-body">
                                    <h6 class="card-title mb-4">Change Password</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Old Password</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                        @if ($errors->has('current_password'))
                                            <div class="alert alert-info">
                                                <strong>{{ $errors->first('current_password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                        @if ($errors->has('new_password'))
                                            <div class="alert alert-info">
                                                <strong>{{ $errors->first('new_password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password Repeat</label>
                                        <input type="password" class="form-control" name="confirm_new_password" required>
                                        @if ($errors->has('confirm_new_password'))
                                            <div class="alert alert-info">
                                                <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <button type="submit" title="Update Logo " class="btn btn-primary btn-icon">
                                        Change Password
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <!--/span-->

            </div>
            <!--/row-->

            <div class="modal fade modal-wide" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Select location</h4>
                        </div>
                        <div class="modal-body">
                            <div id='map_canvas'></div>
                            <div id="current">Nothing yet...</div>
                            <input type="hidden" id="pick-lat" />
                            <input type="hidden" id="pick-lng" />

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-custom select-location">Select Location</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <script src="{{ URL::to('dashboard_assets/stuff/js/select-category.js') }}"></script>

            <script src="{{ URL::to('dashboard_assets/stuff/js/category-slide.js') }}"></script>
        @endsection
