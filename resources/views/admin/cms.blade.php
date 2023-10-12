@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">

            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

            <div class="col-xl-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h4 class="block-title">
                                Update {{str_replace("-"," ",ucwords(request()->segment(4)))}}
                        </h4>
                    </div>
                    <div class="block-content block-content-full ">
                        <div class="card-body">
                            @if(session('response'))

                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <h3 class="alert-heading fs-5 fw-bold mb-1">Success</h3>
                                    <p class="mb-0">
                                        {{session('response')}}
                                    </p>
                                </div>
                            @endif

                            <form role="form" method="post" class="validate"  action="{{ url('admin/secure/cms/update')}}"  enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @foreach($page_info as $row)
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="example-text-input-floating"  name="title" value="{{$row->title}}">
                                    <label class="form-label" for="example-text-input-floating">Title</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <label for="js-ckeditor5-classic">Description</label>
                                    <textarea type="text" class="form-control" id="js-ckeditor5-classic" name="desc"> {!! $row->desc !!}</textarea>
                                </div>
                                <input type="hidden" name="id" value="{{$row->id}}">

                                @endforeach

                                <button type="submit" class="btn btn-secondary mb-2"><i class="glyphicon glyphicon-plus"></i> Update </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>



@endsection
