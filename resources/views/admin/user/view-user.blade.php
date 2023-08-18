@extends('admin.template')
@section('content')
    @include('admin.layout.side-bar')

    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                All Account Users
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
                            <td>{{$row->created_at}}</td>


                            <td>
                                @if($row->user_status == 0)
                                    <form action="{{ route('admin.user.enabling') }}" method="post" class="login">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$row->id}}"/>
                                        <input type="hidden" name="status" value="1"/>
                                        <button class="btn btn-success btn-sm view-shop" type="submit">
                                            <i class="glyphicon glyphicon-edit icon-white"></i> Enable User
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.user.enabling') }}" method="post" class="login">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$row->id}}"/>
                                        <input type="hidden" name="status" value="0"/>
                                        <button class="btn btn-danger btn-sm view-shop" type="submit">
                                            <i class="glyphicon glyphicon-edit icon-white"></i> Disable User
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
