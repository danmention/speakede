@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <main>
        <div class="content">

            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

            <div class="col-xl-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            All Courses
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Course Title</th>
                                    <th>Tutor</th>
                                    <th>Price</th>
                                    <th>No of lessons </th>
                                    <th>Status</th>
                                    <th>Total Transactions</th>
                                    <th>Date created</th>
                                    <th>Date Updated</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $x = 1?>
                                @foreach($course as $row)
                                    <tr >
                                        <td>{{$x++}}</td>
                                        <td>{{$row->title}}</td>
                                        <td> {{$row->firstname. ' '.$row->firstname}}</td>
                                        <td>₦{{number_format($row->price)}}</td>
                                        <td>{{$row->number_of_lessons}}</td>
                                        <td>
                                            @if($row->status ==1 )
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Deactivated</span>
                                            @endif
                                        </td>
                                        <td>{{$row->total}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>{{$row->updated_at}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-default-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-primary">
                                                    <a class="dropdown-item" href="{{url('course/'.$row->url)}}" target="_blank">Course views</a>
                                                    <a class="dropdown-item" href="{{url('admin/secure/course/transactions/'.$row->id)}}">Course Purchases</a>

                                                    @foreach(\App\Http\Controllers\Admin\AdminController::getAccessControl(auth()->user()->id) as $rw)

                                                        @if($rw->title === "Approve")
                                                            <div class="dropdown-divider"></div>

                                                            @if($row->status ==1 )
                                                                <form action="{{route('admin.course.enable.disable')}}" method="post"
                                                                      onclick="return confirm('Are you sure?')">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id" value="{{$row->id}}"/>
                                                                    <input type="hidden" name="status" value="0"/>
                                                                    <button class="btn btn-sm" value="Disable User">
                                                                        Restrict/Deactivate course
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('admin.course.enable.disable')}}" method="post"
                                                                      onclick="return confirm('Are you sure?')">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id" value="{{$row->id}}"/>
                                                                    <input type="hidden" name="status" value="1"/>
                                                                    <button class="btn btn-sm" value="Enable User">
                                                                        Enable course
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
