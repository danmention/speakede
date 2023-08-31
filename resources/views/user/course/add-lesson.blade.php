@extends('user.template')
@section('content')
    @include('user.layout.side-bar')

    @php
        use Illuminate\Http\Request;
        use App\Models\Lesson;
    @endphp

    <main>
        <div class="content">

            @if($lessons > 0)

                <div class="row">
                    <div class="col-6 col-xl-3">
                        <a class="block block-rounded block-link-shadow text-end" href="{{url(\Illuminate\Support\Facades\URL::current().'?action=true')}}">
                            <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                                <div class="d-none d-sm-block">
                                    <i class="fa fa-book fa-2x opacity-25"></i>
                                </div>
                                <div>
                                    <div class="fs-sm fw-semibold text-uppercase text-muted">Existing Lesson</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-6 col-xl-3">
                        <a class="block block-rounded block-link-shadow text-end" href="{{url(\Illuminate\Support\Facades\URL::current().'?action=false')}}">
                            <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                                <div class="d-none d-sm-block">
                                    <i class="fa fa-book fa-2x opacity-25"></i>
                                </div>
                                <div>
                                    <div class="fs-sm fw-semibold text-uppercase text-muted">New Lesson</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            @endif


            @if($lessons == 0 || !empty(\Request::query('action')))
                @foreach($course as $row)
                <div class="col-xl-11">

                    @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif


                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session('error') }}
                        </div>
                    @endif


                    <div class="block block-rounded h-100 mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Add Lesson ({{$row->title}})</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form role="form" method="post" class="validate" action="{{ route('user.dashboard.course.lesson.save') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="course_id" value="{{$row->id}}" type="hidden">
                                <div class="row mb-4">

                                    @if(\Request::query('action') === "true")
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <select name="existing" class="form-control" required="required">
                                                @foreach(Lesson::query()->where('course_id', $row->id)->groupBy('group_id')->get() as $rw)
                                                    <option value="{{$rw->group_id}}"> {{$rw->lesson_name}}</option>
                                                @endforeach
                                            </select>

                                            <label class="form-label" for="register4-firstname">Select Lesson Name</label>
                                        </div>
                                    </div>
                                    @else
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="register4-firstname" name="lesson_name" placeholder="Enter lesson name"  required="required">
                                                <label class="form-label" for="register4-firstname">Lesson Name</label>
                                            </div>
                                        </div>

                                    @endif
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="price" name="title" placeholder="Enter title"  required="required">
                                            <label class="form-label" for="register4-lastname">Lesson Title</label>
                                        </div>
                                    </div>

                                </div>


                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="datetime-local" class="form-control" id="register4-firstname" name="start_time"  required="required">
                                            <label class="form-label" for="register4-firstname">Start DateTime</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="datetime-local" class="form-control" id="price" name="end_time"  required="required">
                                            <label class="form-label" for="register4-lastname">End DateTime</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="desc" rows="5" style="width: 100%;border: 1px solid #d8dde5;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-floating">
                                        <textarea type="text" class="form-control"  name="youtube_link" rows="3" placeholder="Enter your company"  required="required"></textarea>
                                        <label class="form-label" for="register4-email"> Youtube link (eg https://www.youtube.com/watch?v=xxxxxxx )</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus opacity-50 me-1"></i> ADD
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </form>

                </div>
                @endforeach
            @endif

        </div>

    </main>

    <script src="{{ URL::to('home/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('home/assets/js/main-scripts.js') }}"></script>
@endsection
