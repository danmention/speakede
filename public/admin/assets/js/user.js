
var SITE_URL = window.location.origin;
function loadUrl(){
    window.location.href = SITE_URL+'/user/discover';
}

$(function(){
    var requiredCheckboxes = $('.options :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});

let toast = Swal.mixin({
    buttonsStyling: false,
    target: '#page-container',
    customClass: {
        confirmButton: 'btn btn-success m-1',
        cancelButton: 'btn btn-danger m-1',
        input: 'form-control'
    }
});

$("#postFormCourse").submit(function(e){
    e.preventDefault();

    $('#loading').addClass('loading');
    $('#loading-content').addClass('loading-content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var input = document.querySelector('input[type="file"]')
    var data = new FormData()
    var use_cases_id = Object.assign([], $("select[name='use_cases_id']").val());
    data.append('picture', input.files[0])
    data.append('title',$("input[name='title']").val())
    data.append('use_cases_id',JSON.stringify(use_cases_id))
    data.append('price',$("input[name='price']").val())
    data.append('language', $("select[name='language']").val())
    data.append('youtube_link',$("textarea[name='youtube_link']").val())
    data.append('desc',$("textarea[name='desc']").val())
    data.append('course_type',$("select[name='course_type']").val())

    $.ajax({
        url: SITE_URL+'/user/course/add',
        type: "POST",
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        statusCode: {
            500: function(response) {
                console.log(response)
                toast.fire('Oops...', 'Something went wrong!', 'error');

                $('#loading').removeClass('loading');
                $('#loading-content').removeClass('loading-content');
            }
        },
        success: function (result) {

            $('#loading').removeClass('loading');
            $('#loading-content').removeClass('loading-content');

            toast.fire('Success', 'Course added successfully', 'success');

            $(".swal2-confirm").click(function(event){
                window.location.href = SITE_URL+'/user/course/all';
            });

        }
    });
});

$("#postFormProfilePhoto").submit(function(e){
    e.preventDefault();

    $('#loading').addClass('loading');
    $('#loading-content').addClass('loading-content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var input = document.querySelector('input[type="file"]')
    var data = new FormData()
    data.append('picture', input.files[0])

    $.ajax({
        url: SITE_URL+'/actions/profile/photo/save',
        type: "POST",
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        statusCode: {
            500: function(response) {
                console.log(response)
                toast.fire('Oops...', 'Something went wrong!', 'error');

                $('#loading').removeClass('loading');
                $('#loading-content').removeClass('loading-content');
            }
        },
        success: function (result) {

            $('#loading').removeClass('loading');
            $('#loading-content').removeClass('loading-content');

            toast.fire('Success', 'Profile Photo added successfully', 'success');

            $(".swal2-confirm").click(function(event){
                window.location.href = SITE_URL+'/user/dashboard';
            });

        }
    });
});

$("#postFormChangePassword").submit(function(e){
    e.preventDefault();

    $('#loading').addClass('loading');
    $('#loading-content').addClass('loading-content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var data = new FormData()
    data.append('current_password',$("input[name='current_password']").val())
    data.append('confirm_new_password',$("input[name='confirm_new_password']").val())
    data.append('new_password',$("input[name='new_password']").val())

    $.ajax({
        url: SITE_URL+'/actions/change/password/save',
        type: "POST",
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        statusCode: {
            500: function(response) {
                toast.fire('Oops...', response.responseJSON, 'error');

                $('#loading').removeClass('loading');
                $('#loading-content').removeClass('loading-content');
            }
        },
        success: function (result) {

            $('#loading').removeClass('loading');
            $('#loading-content').removeClass('loading-content');

            toast.fire('Success', 'Password Changed successfully', 'success');

            $(".swal2-confirm").click(function(event){
                window.location.href = SITE_URL+'/user/dashboard';
            });

        }
    });
});

$("#postFormSessionCourse").submit(function(e){
    e.preventDefault();

    $('#loading').addClass('loading');
    $('#loading-content').addClass('loading-content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var input = document.querySelector('input[type="file"]')
    var data = new FormData()
    data.append('picture', input.files[0])
    data.append('title',$("input[name='title']").val())
    data.append('price',$("input[name='price']").val())
    data.append('language', $("select[name='language']").val())
    data.append('slot',$("input[name='slot']").val())
    data.append('start_date',$("input[name='start_date']").val())
    data.append('duration',$("input[name='duration']").val())
    data.append('description',$("textarea[name='description']").val())
    data.append('class_type',$("select[name='class_type']").val())

    $.ajax({
        url: SITE_URL+'/user/group/create/save',
        type: "POST",
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        statusCode: {
            500: function(response) {
                console.log(response)
                toast.fire('Oops...', 'Something went wrong!', 'error');

                $('#loading').removeClass('loading');
                $('#loading-content').removeClass('loading-content');
            }
        },
        success: function (result) {

            $('#loading').removeClass('loading');
            $('#loading-content').removeClass('loading-content');

            toast.fire('Success', 'Group Online Session added successfully', 'success');

            $(".swal2-confirm").click(function(event){
                window.location.href = SITE_URL+'/user/group/class/all';
            });

        }
    });
});

$("#postFormLesson").submit(function(e){
    e.preventDefault();

    $('#loading').addClass('loading');
    $('#loading-content').addClass('loading-content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var data = new FormData()
    data.append('existing',$("select[name='existing']").val())
    data.append('title',$("input[name='title']").val())
    data.append('youtube_link',$("textarea[name='youtube_link']").val())
    data.append('course_id',$("input[name='course_id']").val())
    data.append('lesson_name',$("input[name='lesson_name']").val())
    data.append('desc',$("textarea[name='desc']").val())


    $.ajax({
        url: SITE_URL+'/user/course/lesson/save',
        type: "POST",
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        statusCode: {
            500: function(response) {
                console.log(response)
                toast.fire('Oops...', 'Something went wrong!', 'error');

                $('#loading').removeClass('loading');
                $('#loading-content').removeClass('loading-content');
            }
        },
        success: function (result) {

            $('#loading').removeClass('loading');
            $('#loading-content').removeClass('loading-content');

            toast.fire('Success', 'Lesson added successfully', 'success');

            $(".swal2-confirm").click(function(event){
                window.location.href = SITE_URL+'/user/course/all';
            });

        }
    });
});

