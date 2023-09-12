@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    <main>
        <div class="content">

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        @if(request()->segment(2) === "meeting" && request()->segment(4) === "paid")
                            All Paid Private Session
                        @elseif(request()->segment(2) === "schedule" && request()->segment(4) === "view")
                            All Created Private Session
                        @elseif(request()->segment(2) === "meeting" && request()->segment(4) === "sold")
                            All Sold Private Session
                        @else
                            All  Private Session
                        @endif

                    </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th></th>
                                @if(request()->segment(2) === "meeting" && request()->segment(4) === "paid")
                                @else
                                <th>Learner</th>
                                @endif
                                @if(request()->segment(2) === "meeting" && request()->segment(4) === "sold")
                                @else
                                <th>Tutor</th>
                                @endif
                                <th>Description</th>
                                <th>Meeting Time</th>
                                <th>Meeting Duration</th>
                                <th>Meeting Link</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $x = 1?>
                            @foreach($data as $row)
                                <tr>
                                    <td>{{$x++}}</td>
                                    @if(request()->segment(2) === "meeting" && request()->segment(4) === "paid")
                                    @else
                                    <td>{{$row->student}}</td>
                                    @endif
                                    @if(request()->segment(2) === "meeting" && request()->segment(4) === "sold")
                                    @else
                                    <td> {{$row->instructor}}</td>
                                    @endif
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
