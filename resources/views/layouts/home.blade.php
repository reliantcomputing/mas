<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mark allocation system</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="{{asset("mass/stylesheets/fontawesome/css/all.min.css")}}" rel="s">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset("mass/stylesheets/sb-admin-2.min.css")}}" rel="stylesheet">

</head>

<body style="background-image: url({{asset("mass/images/background.jpeg")}});height: auto; width: auto; margin: auto">

@include('layouts/partials.navbars.home')
<div class="container mt-2">
    @include('layouts.messages.message')
</div>

<!-- Page Wrapper -->
<div class="container pt-5">

    @yield('content')

    <!-- Footer -->
    
    <!-- End of Content Wrapper -->

</div>
<footer class="sticky-footer bg-dark">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>
                    Follow us on
                    <a href="https://www.facebook.com/Mark-Allocation-System-424497751481061/">
                        Facebook
                    </a>
                </span>
                &nbsp;
                <span class="text-white">Copyright &copy; Mark Allocation System 2019</span>
            </div>
        </div>
    </footer>
<!-- End of Page Wrapper -->
<!-- Logout Modal-->

<!-- Bootstrap core JavaScript-->
<script src = "{{"mass/javascripts/jquery/jquery.min.js"}}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Core plugin JavaScript-->
<script src = "{{"mass/javascripts/jquery-easing/jquery.easing.min.js"}}"></script>

<script src = "{{"mass/javascripts/validation/dist/jquery.validate.min.js"}}"></script>
<script src = "{{"mass/javascripts/validation.js"}}"></script>

<!-- Custom scripts for all pages-->
<script src = "{{"mass/javascripts/sb-admin-2.min.js"}}"></script>

</body>

</html>
