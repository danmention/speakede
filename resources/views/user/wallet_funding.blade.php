@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    <main>
        <div class="content">

            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

                <div class="row">
                    <div class="col-6 col-xl-3">
                        <div class="block block-rounded block-link-shadow text-end">
                            <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">

                                <div>
                                    <div class="fs-sm fw-semibold text-uppercase text-muted">
                                        <img src="{{asset('home/paystack.png')}}"  style="width: 60%; margin-bottom: 20px"/>
                                    </div>

                                    <form method="POST" action="{{route('user.pay')}}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                                        <input type="hidden" name="orderID" value="{{ \App\Helpers\CommonHelpers::generateCramp('payment') }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="first_name" value="{{Auth::user()->name}}">
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                        <input type="hidden" name="currency" value="NGN">
                                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}

                                        <div class="input-group">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="example-group3-floating2" name="amount"
                                                       placeholder="Enter amount in Kobo">
                                                <label for="example-group3-floating2">Amount</label>
                                            </div>
                                            <button class="btn btn-secondary">Pay</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-xl-3">
                        <div class="block block-rounded block-link-shadow text-end" >
                            <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">


                                <div>
                                    <div class="fs-sm fw-semibold text-uppercase text-muted">
                                        <img src="{{asset('home/flutterwave.png')}}"  style="width: 80%; margin-bottom: 20px"/>
                                    </div>

                                    <form method="POST" action="{{ route('user.pay.rave') }}" id="paymentForm">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                                        <input type="hidden" name="name" value="{{Auth::user()->name}}">
                                        <input type="hidden" name="phone" value="{{Auth::user()->phone}}">

                                        <div class="input-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="example-group3-floating2" name="amount" placeholder="Enter amount">
                                                <label for="example-group3-floating2">Amount</label>
                                            </div>
                                            <button class="btn btn-secondary">Pay</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $x = 1?>
                                        @foreach($payment as $row)
                                            <tr>
                                                <td>{{$x++}}</td>
                                                <td class="fw-semibold">{{\Auth::user()->firstname}}</td>
                                                <td> {{$row->ref_no}}</td>
                                                <td>{{number_format($row->amount)}}</td>
                                                <td>{{$row->description}}</td>
                                                <td>
                                                    @if($row->type ==1 )
                                                        <span class="badge bg-success">CREDIT</span>
                                                    @else
                                                        <span class="badge bg-danger">DEBIT</span>
                                                    @endif
                                                </td>
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
    </main>

@endsection
