@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')


    <main>
        <div class="content">

            <div class="col-xl-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            Bank Account information
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-vcenter js-dataTable-full">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Bank Name</th>
                                    <th>Account Number </th>
                                    <th>Account Name</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $x = 1; ?>
                                @foreach($bank_accounts as $row)
                                    <tr>
                                        <td>{{$x++}}</td>
                                        <td>{{$row->bank_name}}</td>
                                        <td>{{$row->account_number}}</td>
                                        <td>{{$row->account_name}}</td>
                                        <td>{{$row->created_at}}</td>
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
