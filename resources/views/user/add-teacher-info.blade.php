
@extends('user.template')
@section('content')

    <div id="page-container" class="main-content-boxed">
        <main>
            <div class="content">

                <div class="login-register-wrap">
                    <div class="row  d-flex align-items-center justify-content-center">
                        <div class="col-xl-6">


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
                            <h3 class="block-title">Update Personal Information</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form role="form" method="post" class="validate" action="{{ route('user.apply.final.save') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="mb-4">
                                    <label class="form-label" for="val-select2-multiple">Select Language You Teach<span class="text-danger">*</span></label>
                                    <select class="js-select2 form-select" id="val-select2-multiple" name="language_id[]" style="width: 100%;" data-placeholder="Choose at least one.." multiple>
                                        <option></option>
                                       @foreach($lang as $row)
                                            <option value="{{$row->id}}">{{$row->title}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-4">
                                    <label class="form-label" for="val-select2-multiple">Select Language You Speak<span class="text-danger">*</span></label>
                                    <ul style="list-style: none">
                                        @foreach($lang as $row)
                                        <li> <input type="checkbox" name="i_speak_language_id[]" value="{{$row->id}}"> {{$row->title}}</li>
                                        @endforeach
                                    </ul>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea id="js-ckeditor" name="about_me"></textarea>
                                        </div>
                                    </div>
                                </div>

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
                </div>
            </div>
        </main>
    </div>
    <!-- END Page Container -->

@endsection
