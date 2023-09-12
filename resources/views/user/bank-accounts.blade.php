@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">
            <div class="col-xl-12">


                @if(Session::has('message'))
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif


                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ session('error') }}
                    </div>
                @endif


                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Create Withdrawal Details</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form role="form" method="post" class="validate" action="{{ route('user.withdrawal.details.save') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="bank_name" class="form-control" required="required">
                                        <label class="form-label" >Bank Name </label>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="account_name" class="form-control" required="required">
                                        <label class="form-label" >Account Name </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-floating">

                                        <input type="number" name="account_number" class="form-control" required="required">
                                        <label class="form-label" >Account Number</label>

                                    </div>
                                </div>

                            </div>


                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus opacity-50 me-1"></i> CREATE
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <br />

            <div class="col-xl-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            All Bank Account
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
