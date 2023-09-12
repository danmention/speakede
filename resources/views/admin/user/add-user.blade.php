@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')


    <main>
        <div class="content">

            <div class="col-xl-11">


                @if(Session::has('message'))
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif


                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif

                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                            <form role="form" method="post" class="validate" action="{{ route('admin.user.save') }}">
                                {{ csrf_field() }}

                                <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="firstname" class="form-control required" placeholder="Enter FirstName">
                                        <label class="form-label"  for="location">First Name </label>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="lastname" class="form-control required" placeholder="Enter Lastname ">
                                        <label class="form-label"  for="location">Last Name</label>
                                    </div>
                                </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="form-floating">

                                            <input type="email" name="email" class="form-control required" placeholder="Enter Email">
                                            <label class="form-label"  for="location">Email</label>

                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" name="phone" class="form-control required" placeholder="Enter Phone Number ">
                                            <label class="form-label"  for="location">Phone</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="form-floating">
                                               <select name="user_level" class="form-control required">
                                                   <option value="1"> Owner</option>
                                                   <option value="2"> Management</option>
                                                   <option value="3"> Product owner</option>
                                                   <option value="4"> Sales exec</option>
                                                   <option value="5"> Customer exec</option>
                                               </select>
                                            <label class="form-label">Level</label>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="password" name="password" class="form-control required" placeholder="Enter Youtube Iframe ">
                                            <label class="form-label" >Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus opacity-50 me-1"></i> ADD USER
                                    </button>
                                </div>

                            </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
