@extends('home.template')
@section('content')

    <style>
        .single-course-list .course-image a img {
            width: 100px !important;
        }
    </style>


    @foreach($page_info as $row)
    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-color: #FACB27;">
        <div class="shape-3"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <br />
                        <h1>{{$row->title}}</h1>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->


    <!-- Course List Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- Course List Wrapper Start -->
            <div class="course-list-wrapper">
                <div class="row">

                 {!! $row->desc !!}
                </div>
            </div>
            <!-- Course List Wrapper End -->

        </div>
    </div>
    <!-- Course List End -->

    @endforeach


@endsection
