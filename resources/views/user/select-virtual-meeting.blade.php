
@extends('admin.template')
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
                                    <h3 class="block-title">Continue</h3>

                                </div>

                                <div class="block-content">
                                    <p>
                                        Your teacher can use any of the these communication tools. Which communication tool would you like to use for your lesson?
                                    </p>

                                    <form role="form" method="get" class="validate" action="{{ url('user/apply/booking/lesson/pay?teacher_id='.request()->teacher_id.'&id='.request()->id) }}">
                                        {{ csrf_field() }}
                                        <div class="row mb-4">
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <select name="language" class="form-control">
                                                        @foreach($preferred_lang as $rw)
                                                            <option value="{{$rw->id}}"> {{$rw->title}}</option>
                                                        @endforeach
                                                    </select>

                                                    <label class="form-label" for="register4-firstname">Select Language</label>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <select name="tool" class="form-control">
                                                            <option value="zoom"> Zoom</option>
                                                    </select>

                                                    <label class="form-label" for="register4-firstname">Select Communication Tool </label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="teacher_id" value="{{request()->teacher_id}}">
                                            <input type="hidden" name="id" value="{{request()->id}}">

                                        </div>

                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-plus opacity-50 me-1"></i> Continue
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
