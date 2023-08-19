@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


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
                        <h3 class="block-title">Set Availability</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form role="form" method="post" class="validate" action="{{ route('user.schedule.create') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mb-4">

                                <div class="col-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control"  name="price">
                                        <label class="form-label" for="register4-lastname">Price</label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control"  name="title">
                                        <label class="form-label" for="register4-firstname">Title</label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-floating">
                                        <select name="language_id" class="form-control">
                                            @foreach($preferred_lang as $rw)
                                                <option value="{{$rw->id}}"> {{$rw->title}}</option>
                                            @endforeach
                                        </select>

                                        <label class="form-label" for="register4-firstname">Select Language</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="start" value="{{request()->query('start')}}" readonly>
                                        <label class="form-label" for="register4-lastname">Start Time</label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="end" value="{{request()->query('end')}}" readonly>
                                        <label class="form-label" for="register4-lastname">End Time</label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-floating">
                                        <select name="schedule_type" class="form-control">
                                                <option value="FREE"> FREE</option>
                                            <option value="PAID"> PAID</option>
                                        </select>

                                        <label class="form-label" for="register4-firstname">Type </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea id="js-ckeditor" name="description"></textarea>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="type" value="add">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus opacity-50 me-1"></i> ADD
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                </form>

            </div>

        </div>

    </main>
@endsection
