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
                        Update Language Price
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
                            </tr>
                            </thead>
                            <tbody>

                            <?php $x = 1?>
                            @foreach($preferred_lang as $row)
                                <tr>
                                    <td>{{$x++}}</td>
                                    <td> {{$row->title}}</td>
                                    <td>
                                        <form role="form" method="post" class="validate" action="{{ route('update.user.preferred.language') }}">
                                            <div class="input-group">
                                                    {{ csrf_field() }}
                                                    <div class="form-floating">
                                                        <input type="hidden"  value="{{$row->id}}" name="id">
                                                        <input type="text" class="form-control" placeholder="Price" value="{{$row->price}}" name="price">
                                                        <label for="example-group3-floating2">price</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-secondary">Update</button>
                                            </div>
                                        </form>

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
