@extends('user.template')
@section('content')
    @include('user.layout.side-bar')


    <main>

        <section id="loading">
            <div id="loading-content"></div>
        </section>

        <div class="content">

            <div class="col-xl-11">


                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Create Online Group session</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form role="form" method="post" class="validate" action="#"  enctype="multipart/form-data" style="color:#000000;" id="postFormSessionCourse">
                            {{ csrf_field() }}
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select name="class_type" class="form-control" onchange="showDiv('hidden_div', this)">
                                            <option value="FREE"> FREE</option>
                                            <option value="PAID"> PAID</option>
                                        </select>
                                        <label class="form-label" for="register4-lastname">Type</label>
                                    </div>
                                </div>

                                <div class="col-6" id="course_title">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="title">
                                        <label class="form-label" for="register4-firstname">Title</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-4" id="hidden_div" style=" display: none;">
                                <div class="col-12" >
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="price" name="price">
                                        <label class="form-label" for="register4-lastname">Price</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select name="language" class="form-control">
                                            @foreach($preferred_lang as $rw)
                                                <option value="{{$rw->id}}"> {{$rw->title}}</option>
                                            @endforeach
                                        </select>

                                        <label class="form-label" for="register4-firstname">Select Language</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control"  name="slot" />
                                        <label class="form-label" for="register4-email">Number of Student</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="js-flatpickr form-control" id="example-flatpickr-datetime-24" name="start_date" data-enable-time="true" data-time_24hr="true">
                                        <label class="form-label" for="register4-firstname">Date</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control"  name="duration">
                                        <label class="form-label" for="register4-lastname">Duration in Minutes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" name="picture" required="required">
                                        <label class="form-label" for="register4-firstname">Cover Photo</label>
                                        <input type="hidden" name="home" value="home">
                                    </div>
                                </div>

                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea name="description" rows="4" style="width: 100%;border-color: #d8dde5;"></textarea>
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

        </div>

    </main>

    <script>
        function showDiv(divId, element)
        {
            if(element.value ==="FREE"){
                document.getElementById(divId).style.display = 'none';
            } else {
                document.getElementById(divId).style.display = 'block';

            }
        }
    </script>
@endsection
