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
                        <h3 class="block-title">Create Group Class</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form role="form" method="post" class="validate" action="{{ route('user.group.class.save') }}">
                            {{ csrf_field() }}
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="title">
                                        <label class="form-label" for="register4-firstname">Title</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="price" name="price">
                                        <label class="form-label" for="register4-lastname">Price</label>
                                    </div>
                                </div>
                            </div>

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
                                        <input type="number" class="form-control"  name="slot" />
                                        <label class="form-label" for="register4-email">SLots</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" name="start_date">
                                        <label class="form-label" for="register4-firstname">Start Date</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="price" name="duration">
                                        <label class="form-label" for="register4-lastname">Duration in Minutes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea id="js-ckeditor" name="description"></textarea>
                                </div>
                            </div>


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
