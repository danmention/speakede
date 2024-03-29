
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Speakede | Admin</title>

    <meta name="description" content="Speakede">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("home/img/cropped-speakede-icon-black-1-32x32.png")}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset("home/img/cropped-speakede-icon-black-1-192x192.png")}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset("home/img/cropped-speakede-icon-black-1-180x180.png")}}">
    <!-- END Icons -->

    <link rel="stylesheet" href="{{asset("admin/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css")}}">
    <link rel="stylesheet" href="{{asset("admin/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css")}}">
    <link rel="stylesheet" href="{{asset("admin/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css")}}">


    <!-- Stylesheets -->
    <!-- Codebase framework -->
    <link rel="stylesheet" id="css-main" href="{{asset("admin/assets/css/codebase.min.css")}}">

    <link rel="stylesheet" href="{{asset("admin/assets/js/plugins/select2/css/select2.css")}}">

    <style>

        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .loading {
            position:fixed;
            z-index:9999;
            top: 0;
            left:-5px;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .loading-content {
            background-image: url("{{asset("logo-black.png")}}");
            background-repeat: no-repeat;
            background-size: contain;
            position: absolute;
            /*border: 16px solid #f3f3f3;*/
            /*border-top: 16px solid #3498db;*/
            width: 50px;
            height: 50px;
            top: 40%;
            left:50%;
            animation-name: fade-in;
            animation-duration: 3s;
            animation-timing-function: ease-in-out;
            animation-direction:alternate;
            animation-iteration-count: 5;
        }


    </style>

</head>

<body>



<section id="loading">
    <div id="loading-content"></div>
</section>
