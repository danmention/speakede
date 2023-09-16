@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">

                        @if(request()->segment(6) === "paid")
                            All Paid Private Session
                        @elseif(request()->segment(6)=== "sold")
                            All Sold Private Session
                        @else
                            All  Private Session
                        @endif

                         ( {{ ucwords( \App\Helpers\CommonHelpers::getName(request()->identity))}} )

                    </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Learner</th>
                                <th>Tutor</th>
                                <th>Title</th>
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
                                    <td>{{$row->student}}</td>
                                    <td> {{$row->instructor}}</td>
                                    <td>{{$row->title}}</td>
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
