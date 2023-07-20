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
                        <h3 class="block-title">Add Profile Picture</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form method="post" action="{{ route('profile.dp.save')}}"  enctype="multipart/form-data" style="color:#000000;">
                            {{ csrf_field() }}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" placeholder="Service Title Here" name="picture">
                                        <label class="form-label" for="register4-firstname">Profile Picture</label>
                                        <input type="hidden" name="home" value="home">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus opacity-50 me-1"></i> UPLOAD
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 </main>
