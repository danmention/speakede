@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        @if(request()->segment(2) === "group" && request()->segment(4) === "paid")
                            All Paid Group Meeting
                        @elseif(request()->segment(2) === "group" && request()->segment(4) === "all")
                            All Created Group Meeting
                        @elseif(request()->segment(2) === "group" && request()->segment(4) === "sold")
                            All Sold Group Meeting
                        @else
                            All Group Meeting
                        @endif
                    </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                @if(request()->segment(4) === "paid")
                                @else
                                <th>No of Available slots</th>
                                <th> No of slots taken</th>
                                @endif
                                <th>Type</th>
                                <th>Description</th>
                                <th>Meeting Time</th>
                                <th>Meeting Duration</th>

                                <th>Meeting Link</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $x = 1?>
                            @foreach($schedule as $row)
                                <tr>
                                    <td>{{$x++}}</td>
                                    <td>{{$row->title}}</td>
                                    @if(request()->segment(4) === "paid")
                                    @else
                                    <td>{{$row->slot}}</td>
                                    <td>{{$row->slot}}</td>
                                    @endif
                                    <td>{{$row->type}}</td>
                                    <td>{{$row->zoom_response["agenda"]}}</td>
                                    <td>{{$row->zoom_response["start_time"]}}</td>
                                    <td>{{$row->zoom_response["duration"]}} mins</td>
                                    <td><a href="{{$row->zoom_response["start_url"]}}" target="_blank">Meeting Link</a>
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
