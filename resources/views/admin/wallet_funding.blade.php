@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">

            <div class="col-xl-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            Fund History
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-vcenter js-dataTable-full">
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
    </main>
@endsection
