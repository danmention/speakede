@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">

            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">

                            All Group Sessions
                    </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>No of Available slots</th>
                                <th> No of slots taken</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Meeting Time</th>
                                <th>Meeting Duration</th>
                                <th>Total Transactions</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $x = 1?>
                            @foreach($schedule as $row)
                                <tr>
                                    <td>{{$x++}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->slot}}</td>
                                    <td>{{$row->slot}}</td>
                                    <td>
                                        @if($row->status ==1 )
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Deactivated</span>
                                        @endif
                                    </td>
                                    <td>{{$row->zoom_response["agenda"]}}</td>
                                    <td>{{$row->zoom_response["start_time"]}}</td>
                                    <td>{{$row->zoom_response["duration"]}} mins</td>
                                    <td>{{$row->total}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-default-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-primary">
                                                <a class="dropdown-item" href="{{url('online-sessions/'.$row->url)}}" target="_blank">Session views</a>
                                                <a class="dropdown-item" href="{{url('admin/secure/group-sessions/transactions/'.$row->id)}}">Session Purchases</a>

                                                @foreach(\App\Http\Controllers\Admin\AdminController::getAccessControl(auth()->user()->id) as $rw)

                                                    @if($rw->title === "Approve")
                                                        <div class="dropdown-divider"></div>

                                                        @if($row->status ==1 )
                                                            <form action="{{route('admin.session.enable.disable')}}" method="post"
                                                                  onclick="return confirm('Are you sure?')">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{$row->id}}"/>
                                                                <input type="hidden" name="status" value="0"/>
                                                                <button class="btn btn-sm" value="Disable User">
                                                                    Restrict/Deactivate Session
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{route('admin.session.enable.disable')}}" method="post"
                                                                  onclick="return confirm('Are you sure?')">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{$row->id}}"/>
                                                                <input type="hidden" name="status" value="1"/>
                                                                <button class="btn btn-sm" value="Enable User">
                                                                    Enable Session
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
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
