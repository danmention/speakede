
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Page not found</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{asset("admin/assets/css/codebase.min.css")}}">


</head>

<body>

<div id="page-container" class="main-content-boxed">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="hero bg-body-extra-light">
            <div class="hero-inner">
                <div class="content content-full">
                    <div class="py-4 text-center">
                        <div class="display-1 fw-bold text-flat">
                            <i class="far fa-times-circle opacity-50 me-1"></i> 500
                        </div>
                        <h1 class="fw-bold mt-5 mb-2">Oops.. You just found an error page..</h1>
                        <h2 class="fs-4 fw-medium text-muted mb-5">We are sorry but your request contains bad syntax and cannot be fulfilled..</h2>
                        <a class="btn btn-lg btn-alt-secondary" href="be_pages_error_all.html">
                            <i class="fa fa-arrow-left opacity-50 me-1"></i> Back to all Errors
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

<!--
    Codebase JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="{{asset("admin/assets/js/codebase.app.min.js")}}"></script>
</body>
</html>
