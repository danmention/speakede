@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Fund History
            </h3>
        </div>
        <div class="block-content block-content-full">
            <div>
                <div class="row dt-row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name
                                </th>
                                <th>Token Number</th>
                                <th>Amount </th>
                                <th>Description</th>

                                <th>Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $x = 1?>
                            @foreach($payment as $row)
                                <tr class="odd">
                                    <td class="text-center sorting_1">{{$x++}}</td>
                                    <td class="fw-semibold">{{$row->user}}</td>
                                    <td class="d-none d-sm-table-cell"> {{$row->ref_no}}</td>
                                    <td class="d-none d-sm-table-cell">{{$row->amount}}</td>
                                    <td class="d-none d-sm-table-cell">{{$row->description}}</td>
                                    <td class="d-none d-sm-table-cell">

                                        @if($row->status ==1 )
                                            <span class="badge bg-success">Success</span>
                                        @else
                                            <span class="badge bg-danger">Failed</span>
                                        @endif
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
@endsection
