@extends('home.template')
@section('content')

    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-image: url({{asset("home/assets/images/bg/page-banner.jpg")}});">
        <div class="shape-1">
            <img src="{{asset("home/assets/images/shape/shape-7.png")}}" alt="">
        </div>
        <div class="shape-2">
            <img src="{{asset("home/assets/images/shape/shape-1.png")}}" alt="">
        </div>
        <div class="shape-3"></div>
        <div class="container">
            <!-- Course Details Banner Content Start -->
            <div class="course-details-banner-content">

                <h2 class="title">Getting Started with the Linux Command Line </h2>

                <p class="text">Learn Python like a Professional Start from the basics and go all the way to creating your own applications and games</p>

                <div class="course-details-meta">
                    <div class="meta-action">
                        <div class="meta-author">
                            <img src="{{asset("home/assets/images/author-3.jpg")}}" alt="Author">
                        </div>
                        <div class="meta-name">
                            <p class="name">Adam Helen</p>
                        </div>
                    </div>

                    <div class="meta-action">
                        <h5 class="date">Last Update: <span>2/12/2023</span></h5>
                    </div>
                    <div class="meta-action">
                        <div class="rating">
                            <div class="rating-star">
                                <div class="rating-active" style="width: 100%;"></div>
                            </div>
                            <span>(4.5)</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Course Details Banner Content End -->
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Course Details Start -->
    <div class="section section-padding">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-xl-7 col-lg-8">

                    <!-- Course Details Wrapper Start -->
                    <div class="course-details-wrapper">

                        <!-- Course Overview Start -->
                        <div class="course-overview">
                            <h3 class="title">Course Overview</h3>
                            <p>World-class training and development programs developed by top teachers. Build skills with courses, certificates, and degrees online from world-class universities and companies. from the National Research University Higher School of Economics (HSE University) is the first fully online.</p>
                        </div>
                        <!-- Course Overview End -->

                        <!-- Course Learn List Start -->
                        <div class="course-learn-list">
                            <h3 class="title">What you will learn</h3>
                            <ul>
                                <li>Become a UX designer.</li>
                                <li>Become a UX designer.</li>
                                <li>You will be able to add UX designer to your CV</li>
                                <li>You will be able to add UX designer to your CV</li>
                                <li>Build & test a full website design.</li>
                                <li>Build & test a full website design.</li>
                            </ul>
                        </div>
                        <!-- Course Learn List End -->

                        <!-- Course Lessons Start -->
                        <div class="course-lessons">

                            <div class="lessons-top">
                                <h3 class="title">Course Content</h3>
                                <div class="lessons-time">
                                    <span>10 Lessons</span>
                                    <span>6h 40m</span>
                                </div>
                            </div>

                            <!-- Course Accordion Start -->
                            <div class="course-accordion accordion" id="accordionCourse">
                                <div class="accordion-item">
                                    <button data-bs-toggle="collapse" data-bs-target="#collapseOne">Introduction </button>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionCourse">
                                        <div class="accordion-body">
                                            <ul class="lessons-list">
                                                <li><a href=""><i class="fa fa-play-circle"></i> Greetings and Introductions <span>5:00</span></a></li>
                                                <li><a href=""><i class="fa fa-play-circle"></i> 5 Business English Phrasal Verbs <span>3:17</span></a></li>
                                                <li><a href=""><i class="fa fa-question-circle"></i> Quizz 1 : How to start?</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo">Analysis</button>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionCourse">
                                        <div class="accordion-body">
                                            <ul class="lessons-list">
                                                <li><a href=""><i class="fa fa-play-circle"></i> Greetings and Introductions <span>5:00</span></a></li>
                                                <li><a href=""><i class="fa fa-play-circle"></i> 5 Business English Phrasal Verbs <span>3:17</span></a></li>
                                                <li><a href=""><i class="fa fa-question-circle"></i> Quizz 1 : How to start?</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree">Practical</button>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionCourse">
                                        <div class="accordion-body">
                                            <ul class="lessons-list">
                                                <li><a href=""><i class="fa fa-play-circle"></i> Greetings and Introductions <span>5:00</span></a></li>
                                                <li><a href=""><i class="fa fa-play-circle"></i> 5 Business English Phrasal Verbs <span>3:17</span></a></li>
                                                <li><a href=""><i class="fa fa-question-circle"></i> Quizz 1 : How to start?</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Course Accordion End -->

                        </div>
                        <!-- Course Lessons End -->

                        <!-- Course Instructor Start -->
                        <div class="course-instructor">
                            <h3 class="title">Course Instructor</h3>

                            <div class="instructor-profile">
                                <div class="profile-images">
                                    <img src="assets/images/author-5.jpg" alt="author">
                                </div>
                                <div class="profile-content">
                                    <h5 class="name">Alena Hedge</h5>

                                    <div class="profile-meta">
                                        <div class="rating">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 100%;"></div>
                                            </div>
                                            <span>(4.6)</span>
                                        </div>
                                        <span class="meta-action"><i class="fa fa-play-circle"></i> 10 Tutorials</span>
                                        <span class="meta-action"><i class="far fa-user"></i> 134 Students</span>
                                    </div>

                                    <p>World-class training and development programs developed by top teachers. Build skills with courses, certificates, and degrees online from world-class universities </p>

                                </div>
                            </div>
                        </div>
                        <!-- Course Instructor End -->

                        <!-- Course Review Start -->
                        <div class="course-review">
                            <h3 class="title">Review</h3>

                            <!-- Review Rating Start -->
                            <div class="review-rating">

                                <div class="rating-box">
                                    <span class="count">5.0</span>
                                    <div class="rating-star">
                                        <div class="rating-active" style="width: 100%;"></div>
                                    </div>
                                    <p>Total 2 Ratings</p>
                                </div>
                                <div class="rating-percentage">

                                    <!-- Course Review Start -->
                                    <div class="single-rating-percentage">
                                        <span class="label">5 Stars</span>
                                        <div class="rating-line">
                                            <div class="line-bar" style="width: 90%;"></div>
                                        </div>
                                        <span class="label">90%</span>
                                    </div>
                                    <!-- Course Review End -->

                                    <!-- Course Review Start -->
                                    <div class="single-rating-percentage">
                                        <span class="label">4 Stars</span>
                                        <div class="rating-line">
                                            <div class="line-bar" style="width: 40%;"></div>
                                        </div>
                                        <span class="label">40%</span>
                                    </div>
                                    <!-- Course Review End -->

                                    <!-- Course Review Start -->
                                    <div class="single-rating-percentage">
                                        <span class="label">3 Stars</span>
                                        <div class="rating-line">
                                            <div class="line-bar" style="width: 20%;"></div>
                                        </div>
                                        <span class="label">20%</span>
                                    </div>
                                    <!-- Course Review End -->

                                    <!-- Course Review Start -->
                                    <div class="single-rating-percentage">
                                        <span class="label">2 Stars</span>
                                        <div class="rating-line">
                                            <div class="line-bar" style="width: 0%;"></div>
                                        </div>
                                        <span class="label">15%</span>
                                    </div>
                                    <!-- Course Review End -->

                                    <!-- Course Review Start -->
                                    <div class="single-rating-percentage">
                                        <span class="label">1 Stars</span>
                                        <div class="rating-line">
                                            <div class="line-bar" style="width: 0%;"></div>
                                        </div>
                                        <span class="label">10%</span>
                                    </div>
                                    <!-- Course Review End -->

                                </div>

                            </div>
                            <!-- Review Rating End -->

                            <!-- Review Items Start -->
                            <div class="review-items">
                                <ul>
                                    <li>
                                        <!-- Single Review Start -->
                                        <div class="single-review">
                                            <div class="review-author">
                                                <img src="{{asset("home/assets/images/author-4.jpg")}}" alt="Author">
                                            </div>
                                            <div class="review-content">
                                                <div class="review-top">
                                                    <h4 class="name">David Gea</h4>
                                                    <div class="rating-star">
                                                        <div class="rating-active" style="width: 100%;"></div>
                                                    </div>
                                                    <span class="date">5 Months Ago</span>
                                                </div>
                                                <p>World-class training and development programs developed by top teachers. Build skills with courses, certificates, and degrees online from world-class.</p>
                                            </div>
                                        </div>
                                        <!-- Single Review End -->
                                    </li>
                                    <li>
                                        <!-- Single Review Start -->
                                        <div class="single-review">
                                            <div class="review-author">
                                                <img src="{{asset("home/assets/images/author-3.jpg")}}" alt="Author">
                                            </div>
                                            <div class="review-content">
                                                <div class="review-top">
                                                    <h4 class="name">Andrew paker</h4>
                                                    <div class="rating-star">
                                                        <div class="rating-active" style="width: 60%;"></div>
                                                    </div>
                                                    <span class="date">4 Months Ago</span>
                                                </div>
                                                <p>World-class training and development programs developed by top teachers. Build skills with courses, certificates, and degrees online from world-class.</p>
                                            </div>
                                        </div>
                                        <!-- Single Review End -->
                                    </li>
                                </ul>
                            </div>
                            <!-- Review Items End -->

                        </div>
                        <!-- Course Review End -->

                    </div>
                    <!-- Course Details Wrapper End -->

                </div>

                <div class="col-lg-4">
                    <!-- Sidebar Wrapper Start -->
                    <div class="sidebar-details-wrap">

                        <!-- Sidebar Details Video Description Start -->
                        <div class="sidebar-details-video-description">
                            <div class="sidebar-video">
                                <img src="{{asset("home/assets/images/courses/sidebar-video.jpg")}}" alt="video">
                                <a href="https://www.youtube-nocookie.com/embed/Ga6RYejo6Hk" class="popup-video play"><i class="fa fa-play"></i></a>
                            </div>
                            <div class="sidebar-description">
                                <div class="price-wrap">
                                    <span class="label">Price  :</span>
                                    <div class="price">
                                        <span class="sale-price">$49.99</span>
                                        <span class="regular-price">$102</span>
                                    </div>
                                </div>
                                <ul class="description-list">
                                    <li><i class="flaticon-wall-clock"></i> Duration <span>52 mins</span></li>
                                    <li><i class="fas fa-sliders-h"></i> Level <span>Expert</span></li>
                                    <li><i class="far fa-file-alt"></i> Lectures <span>4 Lectures</span></li>
                                    <li><i class="fas fa-language"></i> Language <span>English</span></li>
                                    <li><i class="far fa-user"></i> Enrolled <span>4 Enrolled</span></li>
                                </ul>
                                <a class="btn w-100" href="#">Add To Cart</a>
                                <div class="share-link">
                                    <div class="link-icon">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                    <a class="share-btn" href="#"> Share This Course</a>
                                    <div class="social-share-wrapper">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Details Video Description End -->


                    </div>
                    <!-- Sidebar Wrapper End -->
                </div>
            </div>


        </div>
    </div>
    <!-- Course Details End -->

@endsection
