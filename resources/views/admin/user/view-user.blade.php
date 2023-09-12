@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')


    <main>
        <div class="content">

            <div class="col-xl-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            All Users
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-vcenter js-dataTable-full">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $x = 1; ?>
                                @foreach ($users  as $row)

                                    <tr>
                                        <td>{{$x++}}</td>
                                        <td>{{$row->firstname.' '.$row->lastname}}</td>
                                        <td>{{$row->email}}</td>

                                        <td>

                                            @if($row->status ==1 )
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Suspended</span>
                                            @endif
                                        </td>

                                        <td>{{$row->created_at}}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-default-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-primary">
                                                    <a class="dropdown-item" href="{{url('admin/secure/user/dashboard?identity='.$row->identity)}}">View Dashboard</a>

                                                    <a class="dropdown-item" href="{{url('admin/secure/user/withdraw-details/'.$row->id)}}">View Withdrawal Details</a>


                                                    @foreach(\App\Http\Controllers\Admin\AdminController::getAccessControl(auth()->user()->id) as $rw)

                                                        @if($rw->title === "Approve" )
                                                            @if($row->status ==1 )
                                                                <form action="{{route('admin.user.enable.disable')}}" method="post"
                                                                      onclick="return confirm('Are you sure?')">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id" value="{{$row->id}}"/>
                                                                    <input type="hidden" name="status" value="0"/>
                                                                    <button class="btn btn-sm" value="Disable User">
                                                                        Disable User
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('admin.user.enable.disable')}}" method="post"
                                                                      onclick="return confirm('Are you sure?')">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id" value="{{$row->id}}"/>
                                                                    <input type="hidden" name="status" value="1"/>
                                                                    <button class="btn btn-sm" value="Enable User">
                                                                        Enable User
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
        </div>
    </main>
@endsection
