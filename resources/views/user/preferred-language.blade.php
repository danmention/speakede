@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    <main>
        <div class="content">

            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif


            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        My Language
                    </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $x = 1?>
                            @foreach($preferred_lang as $row)
                                <tr>
                                    <td>{{$x++}}</td>
                                    <td> {{$row->title}}</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" placeholder="Price"
                                                       value=" {{$row->price}}">
                                                <label for="example-group3-floating2">price</label>
                                            </div>
                                            <button type="button" class="btn btn-secondary">Update</button>
                                        </div>

                                    </td>
                                    <td></td>
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
