@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">
            <div class="col-xl-12">


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
                        <h3 class="block-title">Update Profile Information</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form role="form" method="post" class="validate" action="{{ route('user.update.profile.save') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @foreach($user as $row)
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="firstname" class="form-control" value="{{$row->firstname}}">
                                        <label class="form-label" >FIRSTNAME </label>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="email" class="form-control" value="{{$row->email}}" readonly>
                                        <label class="form-label" >EMAIL </label>
                                    </div>
                                </div>
                            </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" name="lastname" class="form-control" value="{{$row->lastname}}">
                                            <label class="form-label" >LASTNAME </label>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" name="phone" class="form-control" value="{{$row->phone}}">
                                            <label class="form-label" >PHONE </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <select name="gender" class="form-control">

                                                @if(empty($row->gender))
                                                <option>Select Option</option>
                                                @else
                                                    <option value="{{$row->gender}}">{{$row->gender}}</option>
                                                @endif
                                                <option value="male">MALE</option>
                                                <option value="Female">FEMALE</option>
                                            </select>
                                            <label class="form-label" >GENDER </label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="date" name="dob" class="form-control" value="{{$row->date_of_birth}}">
                                            <label class="form-label" >DATE OF BIRTH </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label" for="val-select2-multiple">Write your bio. Tell us about you<span class="text-danger">*</span></label>
                                        <div>
                                            <textarea name="about_me" rows="4" style="width: 100%;border-color: #d8dde5;" required="required">
                                               {!! $row->about_me !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus opacity-50 me-1"></i> UPDATE
                                </button>
                            </div>

                        </form>
                            </div>

                    </div>
                </div>
            </div>
            <br />
        </div>
    </main>

@endsection
