@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">
            <div class="row">

                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                Group Session Transactions ( {{$course[0]->title}} )
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
                                        <th>Status
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $x = 1?>
                                    @foreach($transactions as $row)
                                        <tr >
                                            <td>{{$x++}}</td>
                                            <td>{{$row->fullname}}</td>
                                            <td> {{$row->reference_no}}</td>
                                            <td>{{$row->amount}}</td>
                                            <td>
                                                <span class="badge bg-success">Success</span>
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
