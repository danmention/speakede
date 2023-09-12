@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


    <main>
        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">

            @foreach($course as $row)
            <div class="col-md-6 col-xl-5">
                <!-- Detailed Project 1 -->
                <div class="block block-rounded h-100 mb-0">

                    <div class="block-content block-content-full bg-body-light text-center">
                        <h4 class="fs-sm text-muted mb-0">{{ucwords($row->title)}}</h4>
                    </div>
                    <div class="block-content text-center">
                       <h3>₦{{number_format($row->price)}}</h3>
                        <p>Available : ₦{{number_format($wallet)}}</p>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row g-sm">
                            <div class="col-6">
                                <a class="btn w-100 btn-alt-secondary" href="{{url('user/course/view/'.$row->url)}}">
                                    <i class="fa fa-eye me-1 text-muted"></i> View
                                </a>
                            </div>

                            @if($row->price > $wallet)
                            <div class="col-6">
                                <a class="btn w-100 btn-alt-secondary" href="{{route('user.dashboard.wallet')}}">
                                    <i class="fa fa-archive me-1 text-muted"></i> Buy SpeakToken
                                </a>
                            </div>
                            @else
                                <div class="col-6">
                                    <form role="form" method="post" class="validate" action="{{ route('user.dashboard.course.buy.save') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="course_id" value="{{$row->id}}">
                                        <input type="hidden" name="course_title" value="{{$row->title}}">
                                        <input type="hidden" name="amount" value="{{$row->price}}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus opacity-50 me-1"></i> Pay Now
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- END Detailed Project 1 -->
                </div>
            @endforeach
        </div>
    </main>
@endsection
