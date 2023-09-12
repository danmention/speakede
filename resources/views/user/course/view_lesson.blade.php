
@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    <main id="main-container">


        <section id="loading">
            <div id="loading-content"></div>
        </section>

        @foreach($lessons as $row)
            <!-- Page Content -->
            <div class="content">
                <nav class="breadcrumb push bg-body-extra-light rounded-pill px-4 py-2">
                    <a class="breadcrumb-item" href="#">Lesson</a>
                    <span class="breadcrumb-item active">{{$row->lesson_title}}</span>
                </nav>
                <div class="row">
                    <div class="col-xl-10">
                        <!-- Lessons -->
                        <div class="block block-rounded">
                            <div class="block-content">
                                <!-- Introduction -->

                                @foreach($lessons as $row)
                                    <iframe width="850" height="568" src="https://www.youtube.com/embed/{{substr($row->youtube_link, strpos($row->youtube_link, "watch?v=") + strlen("watch?v="))}}?rel=0&amp;controls=1&amp&amp;showinfo=0&amp;modestbranding=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                                         encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                                    <p>{!! $row->description !!}</p>
                                @endforeach
                                <!-- END Introduction -->
                            </div>
                        </div>
                        <!-- END Lessons -->
                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        @endforeach
    </main>

@endsection
