@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Language
            </h3>
        </div>
        <div class="block-content block-content-full">

            <div class="form-group">
                <div class="ul-category">
                    {!! $category !!}

                </div>
            </div>

                <div class="card radius-15">
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

                    <div class="box-header well" data-original-title="">
                        <h4><i class="glyphicon glyphicon-plus"></i> Add Language</h4>

                    </div>
                    <div class="box-content">
                 <form role="form" method="post" class="validate"  action="{{ route('admin.add.cat.save')}}"  enctype="multipart/form-data">
                 {{ csrf_field() }}



                     <div class="form-floating mb-4">
                         <input type="text" class="form-control" id="example-text-input-floating"  name="category_name"
                                placeholder="Enter Language Name">
                         <label class="form-label" for="example-text-input-floating">Language Name</label>
                     </div>

                     <div class=" mb-4">
                        <label class="form-label" for="image">Language icon *</label>
                          <input class="form-control" type="file" name="post_image" required="required">
                         <input type="hidden" name="class_name" required="required" value="language">
                    </div>


                    <button type="submit" class="btn btn-secondary mb-2"><i class="glyphicon glyphicon-plus"></i> Add Language</button>
                </form>

            </div>
        </div>
                 </div>

            </div>
    </div>



@endsection
