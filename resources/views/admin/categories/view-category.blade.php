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
                        View Language
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
    </main>
@endsection
