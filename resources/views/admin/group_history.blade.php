@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Group Call History
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
                                <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label=": activate to sort column descending"></th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending">Name
                                </th>
                                <th class="d-none d-sm-table-cell sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email
                                </th>
                                <th class="d-none d-sm-table-cell sorting" style="width: 15%;" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Access: activate to sort column ascending">Access
                                </th>
                                <th class="text-center sorting" style="width: 15%;" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Profile: activate to sort column ascending">Profile
                                </th>

                                <th class="text-center sorting" style="width: 15%;" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Profile: activate to sort column ascending">Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="odd">
                                <td class="text-center sorting_1">1</td>
                                <td class="fw-semibold">Ralph Murray</td>
                                <td class="d-none d-sm-table-cell">customer1@example.com</td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="badge bg-success">VIP</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="View Customer" data-bs-original-title="View Customer">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="text-center sorting_1">2</td>
                                <td class="fw-semibold">Carol Ray</td>
                                <td class="d-none d-sm-table-cell">customer2@example.com</td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="badge bg-danger">Disabled</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="View Customer" data-bs-original-title="View Customer">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
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
