@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">
            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
                <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">

                @if(request()->segment(3) === "theme")
                    Edit  Theme
                @else
                    Edit Language
                @endif

            </h3>
        </div>
        <div class="block-content block-content-full">

            <div class="card radius-15">
                <div class="card-body">
                    <div class="box-header well" data-original-title="">
                        <h4><i class="glyphicon glyphicon-plus"></i>
                            @if(request()->segment(3) === "theme")
                                Edit  Theme
                            @else
                                Edit Language
                                @endif
                        </h4>

                    </div>
                    <div class="box-content">
                        <form role="form" method="post" class="validate"  action="{{ route('admin.edit.lang.update')}}"  enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control"  name="title" placeholder="Enter Language Name" value="{{$category[0]->title}}">
                                <input type="hidden" name="id" value="{{$category[0]->id}}">
                                <label class="form-label" for="example-text-input-floating">Language Name</label>
                            </div>

                            <button type="submit" class="btn btn-secondary mb-2"><i class="glyphicon glyphicon-plus"></i> Update</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
        </div>
    </main>



@endsection
