<main>
    <div class="content">

        <div class="col-xl-11">


            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif


            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    {{ session('error') }}
                </div>
            @endif


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
                    <form role="form" method="post" class="validate" action="{{ route('user.password.save') }}"
                                enctype="multipart/form-data">
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
            </div>
        </div>
    </div>
</main>
