@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">

            <div class="col-xl-11">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                           Create Theme
                        </h3>
                    </div>
                    <div class="block-content block-content-full">

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
                                    <h4><i class="glyphicon glyphicon-plus"></i> Add Theme</h4>

                                </div>
                                <div class="box-content">
                                    <form role="form" method="post" class="validate"  action="{{ route('admin.add.use.cases.save')}}"  enctype="multipart/form-data">
                                        {{ csrf_field() }}


                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="example-text-input-floating"  name="title">
                                            <label class="form-label" for="example-text-input-floating">Title</label>
                                        </div>


                                        <button type="submit" class="btn btn-secondary mb-2"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-xl-11">
                <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        View Use Cases
                    </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1; ?>
                            @foreach ($category  as $row)

                                <tr>

                                    <td>{{$x++}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->created_at}}</td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{url('admin/secure/category/edit/'.$row->id)}}"
                                               class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip"
                                               aria-label="Edit" data-bs-original-title="Edit">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('delete.category')}}" method="post"
                                                  onclick="return confirm('Are you sure?')">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$row->id}}"/>
                                                <input type="hidden" name="type" value="business_category"/>
                                                <button class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                        data-bs-toggle="tooltip" aria-label="Delete"
                                                        data-bs-original-title="Delete" style="margin-left: 10px;">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>



@endsection
