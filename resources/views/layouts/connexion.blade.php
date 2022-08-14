<!doctype html>
<html lang="fr">

<head>
    <title>DevHunt - I-CODE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {

            background-position: center;
            background-size: cover;
        }

    </style>

</head>

<body style="background-image: url({{ asset('assets/images/bg.jpg') }});">
    <section class="ftco-section">
        <div class="container">

            @yield('content')
        </div>
    </section>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.min.js') }}"></script>


    <script src="{{asset('assets/js/azzara/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/plugin/chart.js/chart.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/azzara/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/azzara/plugin/jqvmap/maps/jquery.vmap.world.js')}}" charset="utf-8"></script>
    <script src="{{asset('assets/js/azzara/plugin/chart-circle/circles.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/azzara/ready.js')}}"></script>


    @yield("script")
    

    

</body>

</html>
