
<!-- Footer -->
<footer id="page-footer">
    <div class="content py-3">
        <div class="row fs-sm">

            <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                <a class="fw-semibold" href="https://1.envato.market/95j" target="_blank">Speakede</a> &copy; <span data-toggle="year-copy"></span>
            </div>
        </div>
    </div>
</footer>
<!-- END Footer -->
</div>
<!-- END Page Container -->



<script src="{{asset("admin/assets/js/codebase.app.min.js")}}"></script>
<!-- Page JS Plugins -->
<script src="{{asset("admin/assets/js/plugins/sweetalert2/sweetalert2.min.js")}}"></script>

<!-- Page JS Code -->
<script src="{{asset("admin/assets/js/pages/be_comp_dialogs.min.js")}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset("admin/assets/js/plugins/chart.js/chart.umd.js")}}"></script>

<!-- Page JS Code -->
<script src="{{asset("admin/assets/js/pages/be_pages_dashboard.min.js")}}"></script>

<script src="{{asset("admin/assets/js/plugins/simplemde/simplemde.min.js")}}"></script>
<script src="{{asset("admin/assets/js/plugins/ckeditor/ckeditor.js")}}"></script>


<!-- Page JS Helpers (SimpleMDE + CKEditor plugins) -->
<script>Codebase.helpersOnLoad(['js-ckeditor', 'js-simplemde','js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-rangeslider', 'jq-masked-inputs', 'jq-pw-strength']);</script>

<script>
    document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'interactive') {
            $('#loading').addClass('loading');
            $('#loading-content').addClass('loading-content');
        } else if (state == 'complete') {
            setTimeout(function(){
                $('#loading').removeClass('loading');
                $('#loading-content').removeClass('loading-content');
            },1000);
        }
    }

</script>

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var SITE_URL = "{{ url('/') }}";

        // Return today's date and time
        var currentTime = new Date()

        // returns the month (from 0 to 11)
        var month = currentTime.getMonth() + 1

        // returns the day of the month (from 1 to 31)
        var day = currentTime.getDate()

        var full_year = currentTime.getFullYear();


        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: SITE_URL +'/user/schedule/get-availability',
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
               if (confirm("Are you sure you want to schedule ?")) {

                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    window.location.href = SITE_URL+'/user/schedule/availability/create?start='+start+'&end='+end;
                }
            },
            editable: true,
            eventResize: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "{{ route('user.schedule.create') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Availability updated");
                    }
                })
            },
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "{{ route('user.schedule.create') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Availability updated");
                    }
                })
            },
            validRange: {
                start: full_year+"-"+month+"-"+day,
                end: full_year+"-12-30",
            },

            eventClick: function (event) {
                if (confirm("Are you sure you want to remove it?")) {
                    var id = event.id;
                    $.ajax({
                        url: "{{ route('user.schedule.delete') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                            type: "delete"
                        },
                        success: function (response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Availability deleted");
                        }
                    })
                }
            }
        });
    });
</script>

</body>
</html>
