@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')


    <main>
        <div class="content">

            <div class="col-xl-11">

                @if(Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif

                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add User Account</h3>

                    </div>
                    <div class="block-content">
                        <form method="post" action="{{route('index.register.save')}}" enctype="multipart/form-data"  role="form">
                            {{ csrf_field() }}


                            @if(session('response'))

                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <h3 class="alert-heading fs-5 fw-bold mb-1">Success</h3>
                                    <p class="mb-0">
                                        {{session('response')}}
                                    </p>
                                </div>
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


                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Firstname" name="firstname" required="required">
                                        <label class="form-label" >Firstname</label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Lastname" name="lastname" required="required">
                                        <label class="form-label">Lastname</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" placeholder="Email" name="options" required="required">
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="password" name="password_confirmation" placeholder="Retype Password" class="form-control" required="required">
                                        <label class="form-label" for="val-select2-multiple">Retype Password</label>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="mb-4 form-group options">
                                        <label class="form-label" for="val-select2-multiple">I speak<span class="text-danger">*</span></label>

                                        <select class="js-select2 form-select" id="val-select2-multiple" name="i_speak_language_id[]" style="width: 100%;" data-placeholder="Choose at least one.." multiple>
                                            <option></option>
                                            @foreach($lang as $row)
                                                <option value="{{$row->id}}">{{$row->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4">
                                <label class="form-label" for="val-select2-multiple">I’d like to tutor learners</label>
                                <ul style="list-style: none">
                                    @foreach($tutor_lang as $row)
                                        <li> <input type="checkbox" name="language_id[]" value="{{$row->id}}"> {{$row->title}}</li>
                                    @endforeach
                                </ul>
                            </div>




                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="val-select2-multiple">Write your bio. Tell us about you<span class="text-danger">*</span></label>
                                    <div>
                                        <textarea name="about_me" rows="4" style="width: 100%;border-color: #d8dde5;" required="required"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4">
                                <input type="hidden" name="admin" value="admin" required="required">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus opacity-50 me-1"></i> REGISTER
                                </button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
