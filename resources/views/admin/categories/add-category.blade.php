@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">

            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

            <div class="col-xl-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">

                            @if(request()->segment(4) === "tutor")
                              Add  Tutor Language
                            @else
                            Add Global Language
                            @endif
                        </h3>
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

                                <div class="box-header well" data-original-title="">
                                    <h4><i class="glyphicon glyphicon-plus"></i> Add Language</h4>

                                </div>
                            <form role="form" method="post" class="validate"  action="{{ route('admin.add.cat.save')}}"  enctype="multipart/form-data">
                             {{ csrf_field() }}


                                 <div class="form-floating mb-4">
                                     <input type="text" class="form-control" id="example-text-input-floating"  name="category_name" placeholder="Enter Language Name">
                                     @if(request()->segment(4) === "tutor")
                                     <input type="hidden" class="form-control"  name="class_name" value="tutor">
                                     @else
                                         <input type="hidden" class="form-control"  name="class_name" value="language">
                                     @endif
                                     <label class="form-label" for="example-text-input-floating">Language Name</label>
                                 </div>

                                <button type="submit" class="btn btn-secondary mb-2"><i class="glyphicon glyphicon-plus"></i> Add Language</button>
                            </form>

                    </div>
                    </div>
            </div>
            </div>

                <div class="col-xl-12">

                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                @if(request()->segment(4) === "tutor")
                                    View  Tutor Language
                                @else
                                    View Global Language
                                @endif
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Language Name</th>
                                        <th>Language Type</th>
                                        <th>Date Created</th>
                                        <th>Make Popular</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $x = 1; ?>
                                    @foreach ($category  as $row)

                                        <tr>

                                            <td>{{$x++}}</td>
                                            <td>{{$row->title}}</td>
                                            <td>
                                                @if($row->class_name === "language")
                                                    Global Language
                                                @else
                                                    Tutors Language
                                                @endif
                                            </td>
                                            <td>{{$row->created_at}}</td>


                                            <td class="text-center">
                                                @if($row->popular_status == 0)
                                                    <form action="{{route('make.popular.category')}}" method="post"
                                                          onclick="return confirm('Are you sure?')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{$row->id}}"/>
                                                        <input type="hidden" name="popular_status" value="1"/>
                                                        <button class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                                data-bs-toggle="tooltip" aria-label="Delete"
                                                                data-bs-original-title="Delete">
                                                            Make Popular
                                                        </button>
                                                    </form>
                                                @else

                                                    <form action="{{route('make.popular.category')}}" method="post"
                                                          onclick="return confirm('Are you sure?')">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{$row->id}}"/>
                                                        <input type="hidden" name="popular_status" value="0"/>
                                                        <button class="btn btn-sm btn-danger js-bs-tooltip-enabled"
                                                                data-bs-toggle="tooltip" aria-label="Delete"
                                                                data-bs-original-title="Delete">
                                                            Make Unpopular
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{url('admin/secure/language/edit/'.$row->id)}}"
                                                       class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                       data-bs-toggle="tooltip"
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
        </div>
    </main>



@endsection
