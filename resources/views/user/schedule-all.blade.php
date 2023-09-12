@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">

            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif


            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        All Private Schedule Meeting
                    </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $x = 1?>
                            @foreach($schedule as $row)
                                <tr>
                                    <td>{{$x++}}</td>
                                    <td> {{$row->title}}</td>
                                    <td>₦{{number_format($row->price)}}</td>
                                    <td>{{$row->type}}</td>
                                    <td>{{$row->start}}</td>
                                    <td>{{$row->end}}</td>
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
