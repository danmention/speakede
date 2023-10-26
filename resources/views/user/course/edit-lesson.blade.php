@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>


        <div class="content">

                @foreach($lessons as $row)
                    <div class="col-xl-11">


                        <div class="block block-rounded h-100 mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Edit Lesson ({{$row->lesson_title}})</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                            </div>
                            <div class="block-content">
                                <form role="form" method="post" class="validate" action="#" enctype="multipart/form-data" id="editFormLesson">
                                    {{ csrf_field() }}
                                    <input name="course_id" value="{{$row->id}}" type="hidden">
                                    <div class="row mb-4">

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="title" value="{{$row->lesson_title}}">
                                                <label class="form-label" for="register4-lastname">Lesson Title</label>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="mb-4">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea name="desc" rows="5" style="width: 100%;border: 1px solid #d8dde5;">
                                                    {!! $row->description !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="youtube_link" value=" {{$row->youtube_link}}">
                                            <label class="form-label" for="register4-email"> Youtube link (eg https://www.youtube.com/watch?v=xxxxxxx )</label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary">
                                            <input type="hidden" name="lesson_id" value="{{$row->id}}">
                                            <i class="fa fa-plus opacity-50 me-1"></i> UPDATE
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </form>

                    </div>
                @endforeach


        </div>

    </main>

    <script src="{{ URL::to('home/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('home/assets/js/main-scripts.js') }}"></script>
@endsection
