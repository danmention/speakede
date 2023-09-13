@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">
            <div class="row">

                @if($transactions->count() > 0)
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                Group Session Transactions ( {{$transactions[0]->title}} )
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Student</th>
                                        <th>tutor</th>
                                        <th>Course Title</th>
                                        <th>Token Number</th>
                                        <th>Amount </th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $x = 1?>
                                    @foreach($transactions as $row)
                                        <tr >
                                            <td>{{$x++}}</td>
                                            <td>{{$row->student}}</td>
                                            <td>{{$row->tutor}}</td>
                                            <td>{{$row->title}}</td>
                                            <td> {{$row->reference_no}}</td>
                                            <td>{{$row->price}}</td>
                                            <td>
                                                <span class="badge bg-success">Success</span>
                                            </td>
                                            <td>{{$row->created_at}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                Group Session Transactions
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Student</th>
                                        <th>tutor</th>
                                        <th>Course Title</th>
                                        <th>Token Number</th>
                                        <th>Amount </th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>
@endsection
