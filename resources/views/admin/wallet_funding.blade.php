@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">
            <div class="row">
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center bg-primary">
                            <div class="d-none d-sm-block">
                                <i class="fa fa-user fa-2x text-white"></i>
                            </div>
                            <div>
                                <div class="fs-3 fw-semibold text-white">{{$total_transaction}}</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted text-white">Total transaction</div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                Fund History
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                                    <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
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
                                                <tr >
                                                    <td>{{$x++}}</td>
                                                    <td>{{$row->user}}</td>
                                                    <td> {{$row->ref_no}}</td>
                                                    <td>{{$row->amount}}</td>
                                                    <td>{{$row->description}}</td>
                                                    <td>

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
        </div>
    </main>
@endsection
