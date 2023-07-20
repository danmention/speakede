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
                            <h3 class="block-title">Add Course</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form role="form" method="post" class="validate" action="{{ route('user.dashboard.course.add') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="register4-firstname" name="title" placeholder="Enter your firstname">
                                            <label class="form-label" for="register4-firstname">Course Title</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter your lastname">
                                            <label class="form-label" for="register4-lastname">Price</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-floating">
                                        <textarea id="js-ckeditor" name="desc">Description</textarea>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-floating">
                                        <textarea type="text" class="form-control"  name="youtube_link" rows="3" placeholder="Enter your company"></textarea>
                                        <label class="form-label" for="register4-email">Introductory Youtube link (eg https://www.youtube.com/watch?v=xxxxxxxxx )</label>
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
