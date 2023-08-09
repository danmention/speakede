
<!-- Footer Start -->
<div class="footer-section section">
    <div class="container">

        <!-- Footer Widget Wrapper Start -->
        <div class="footer-widget-wrap">
            <div class="row">

                <div class="col-lg-3 col-sm-6">
                    <!-- Footer Widget Start -->
                    <div class="footer-widget widget-about">
                        <div class="footer-logo">
                            <a href="{{url('/')}}"><img src="{{asset("home/img/NewSpeakede-white-1.png")}}" alt=""></a>
                        </div>
                        <p class="text">World largest online learning platform. Download our apps to start learning.</p>
                        <div class="widget-info">
                            <div class="info-icon">
                                <i class="flaticon-phone-call"></i>
                            </div>
                            <div class="info-text">
                                <p class="call-text">Call Us Free</p>
                                <a href="tel:+91458654528">+91 458 654 528</a>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget End -->
                </div>

                <div class="col-lg-3 col-sm-6">
                    <!-- Footer Widget Start -->
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Trending Courses</h4>
                        <div class="widget-link">
                            <ul class="link">
                                <li><a href="index.html">Home </a></li>
                                <li><a href="#">Pricing</a></li>
                                <li><a href="about.html">Compare plans</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget End -->
                </div>

                <div class="col-lg-3 col-sm-6">
                    <!-- Footer Widget Start -->
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Study material</h4>
                        <div class="widget-link">
                            <ul class="link">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="#">Weekly webinar</a></li>
                                <li><a href="#">Academy</a></li>
                                <li><a href="#">Free eBooks & checklists</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget End -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <!-- Footer Widget Start -->
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Download Now</h4>
                        <div class="widget-download">
                            <a href="#"><img src="{{asset("home/assets/images/app-1.jpg")}}" alt=""></a>
                            <a href="#"><img src="{{asset("home/assets/images/app-2.png")}}" alt=""></a>
                        </div>
                    </div>
                    <!-- Footer Widget End -->
                </div>
            </div>
        </div>
        <!-- Footer Widget Wrapper End -->

        <!-- Footer Copyright Start -->
        <div class="footer-copyright">
            <div class="copyright-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <!-- Footer Copyright Text Start -->
                        <div class="copyright-text">
                            <p>© Copyright 2023 upstudy All rights reserved. </p>
                        </div>
                        <!-- Footer Copyright Text End -->
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <!-- Footer Copyright Social Start -->
                        <div class="copyright-social">
                            <ul class="social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- Footer Copyright Social End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Copyright End -->

    </div>
</div>
<!-- Footer End -->

<!-- back to top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- back to top end -->


<!-- course hover Start -->
<div id="course-hover">
    <div class="course-hover">
        <div class="courses-content">
            <div class="top-meta"><a class="tag" href="#">Beginner</a></div>
            <h3 class="title"><a href="{{url('teacher/9109019/english')}}">Design 101: Product & Web Design Course</a></h3>
        </div>
        <div class="rating">
            <div class="rating-star">
                <div class="rating-active" style="width: 60%;"></div>
            </div>
            <span>(4.5)</span>
        </div>
        <p class="price">Free</p>
        <p>World-class training and programs developed by top teachers Lorem ipsum dolor sit amet consectur adip iscing elit sed eiusmod tempor.</p>
        <div class="courses-meta">
            <p class="student"><i class="flaticon-google-docs"></i> 10 Lessons</p>
            <p class="student"><i class="far fa-clock"></i> 03 Hours</p>
        </div>
        <div class="courses-btn"><a class="btn" href="{{url('teacher/9109019/english')}}">Course Full Details</a></div>
    </div>
</div>
<!-- course hover End -->

</div>

<!-- JS
============================================ -->
<script src="{{asset("home/assets/js/vendor/jquery-1.12.4.min.js")}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>


<script>

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var SITE_URL = "{{ url('/') }}";

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            timeZone: 'UTC',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: SITE_URL +'/teacher/schedule/get-availability',
                    dataType: 'json',
                    data: {
                        // our hypothetical feed requires UNIX timestamps
                        start: "2023-07-30",
                        end: "2023-09-10",
                        instructor_user_id: '{{ request()->segment(2) }}'
                    },
                    success: function (doc) {
                        var events = [];
                        $(doc).each(function () {
                            events.push({
                                title: '',
                                start: $(this).attr('start'), // will be parsed
                                end: $(this).attr('end'), // will be parsed
                                event_id: $(this).attr('id') // will be parsed
                            });
                        });
                        callback(events);
                    }
                });
            },
            validRange: {
                start: "2023-08-01",
                end: "2023-08-10",
            },
            selectable: true,
            selectHelper: true,
            eventClick: function (event) {
                var loggedIn = {{ auth()->check() ? 'false' : 'true' }};
                if (loggedIn) {
                    alert("please login")
                    event.preventDefault();
                }
                if (confirm("Are you sure you want to book ?")) {
                    var id = event.event_id;
                    var identity = '{{ request()->segment(2) }}';
                    window.location.href = SITE_URL+'/booking/lesson?teacher_id='+identity+'&id='+id;
                }
            }
        });
    });
</script>
<script src="{{asset("home/assets/js/vendor/modernizr-3.11.2.min.js")}}"></script>

<!-- Bootstrap JS -->
<script src="{{asset("home/assets/js/plugins/popper.min.js")}}"></script>
<script src="{{asset("home/assets/js/plugins/bootstrap.min.js")}}"></script>

<!-- Plugins JS -->
<script src="{{asset("home/assets/js/plugins/swiper-bundle.min.js")}}"></script>
<script src="{{asset("home/assets/js/plugins/aos.js")}}"></script>
<script src="{{asset("home/assets/js/plugins/waypoints.min.js")}}"></script>
<script src="{{asset("home/assets/js/plugins/jquery.counterup.min.js")}}"></script>
{{--<script src="{{asset("home/assets/js/plugins/jquery.nice-select.min.js")}}"></script>--}}
<script src="{{asset("home/assets/js/plugins/back-to-top.js")}}"></script>
<script src="{{asset("home/assets/js/plugins/jquery.powertip.min.js")}}"></script>
<script src="{{asset("home/assets/js/plugins/jquery.magnific-popup.min.js")}}"></script>


<!-- Main JS -->
<script src="{{asset("home/assets/js/main.js")}}"></script>

</body>

</html>
