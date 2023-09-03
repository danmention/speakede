@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    @php
        use Illuminate\Http\Request;
        use App\Models\Lesson;
    @endphp

    <main>
        <div class="content">

            <div class="col-xl-11">

                <h2 class="content-heading d-flex justify-content-between align-items-center">
                        <span>All Tutors </span>
                </h2>

                <div class="row">
                    @foreach($tutors as $row)

                        <div class="col-md-6 col-xl-4">
                            <div class="block block-rounded ">
                                <div class="block-content block-content-full block-content-sm bg-body-light">
                                    <div class="fw-semibold text-center"><a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}}</a></div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    @if(!empty($row->profile_image))
                                        <a href="{{url('teacher/'.$row->identity)}}"> <img src="{{asset('profile/photo/'.$row->id.'/'.$row->profile_image)}}" class="img-avatar img-avatar-thumb"></a>
                                    @else
                                        <a href="{{url('teacher/'.$row->identity)}}"> <img src="{{asset('avater2.png')}}" class="img-avatar img-avatar-thumb"></a>
                                    @endif

                                </div>
                                <div class="block-content block-content-full bg-body-light text-left">
                                    <span class="author-name"><b>TUTOR</b></span>

                                    <div class="top-meta">
                                        <a class="tag" href="#">SPEAKS</a>
                                        @foreach($row["preferred_lang"] as $rw)
                                            <span class="language">{{$rw->title}}</span>
                                        @endforeach

                                    </div>

                                    <a href="{{url('teacher/'.$row->identity)}}" class="btn btn-primary">Book a private session</a>

                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>
    </main>

@endsection
