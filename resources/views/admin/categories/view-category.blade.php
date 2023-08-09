@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                View Language Category
            </h3>
        </div>
        <div class="block-content block-content-full">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="DataTables_Table_0_length"><label>
                                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select></label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>
                                <input type="search" class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0"></label>
                        </div>
                    </div>
                </div>
                <div class="row dt-row">
                    <div class="col-sm-12">
                        <table
                            class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer"
                            id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                            <thead>

                                <tr>

                                    <th>Id</th>
                                    <th>Category Name</th>
                                    <th>Icon</th>
                                    <th>Date Created</th>
                                    <th>Make Popular</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $x = 1; ?>
                                @foreach ($category  as $row)

                                    <tr>

                                        <td class="center">{{$x++}}</td>
                                        <td class="center">{{$row->title}}</td>
                                        <td class="center"> <img src="{{asset('lang/icons/'.$row->featured_img)}}" class="img-avatar" alt="image"></td>
                                        <td class="center">{{$row->created_at}}</td>



                                        <td class="text-center">
                                            @if($row->popular_status == 0)
                                            <form action="{{route('make.popular.category')}}" method="post" onclick="return confirm('Are you sure?')" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$row->id}}"  />
                                                <input type="hidden" name="popular_status" value="1"  />
                                                <button class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                                                   Make Popular
                                                </button>
                                            </form>
                                                @else

                                                <form action="{{route('make.popular.category')}}" method="post" onclick="return confirm('Are you sure?')" >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$row->id}}"  />
                                                    <input type="hidden" name="popular_status" value="0"  />
                                                    <button class="btn btn-sm btn-danger js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                                                       Make Unpopular
                                                    </button>
                                                </form>
                                                @endif

                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{url('admin/secure/category/edit/'.$row->id)}}" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{route('delete.category')}}" method="post" onclick="return confirm('Are you sure?')" >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$row->id}}"  />
                                                    <input type="hidden" name="type" value="business_category"  />
                                                    <button class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                            data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete" style="margin-left: 10px;">
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
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page
                            <strong>1</strong> of <strong>4</strong></div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a
                                        aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link"
                                        data-dt-idx="previous" tabindex="0" class="page-link"><i
                                            class="fa fa-angle-left"></i></a></li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="DataTables_Table_0"
                                       aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                    <a href="#" aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link">
                                        <i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
