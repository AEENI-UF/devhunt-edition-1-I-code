<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} | ERREUR 404</title>


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">


    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style 404.css') }}" />
    <style>
        .notfound .notfound-404 h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 230px;
            margin: 0px;
            font-weight: 900;
            position: absolute;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            background: url("{{asset('assets/images/404.jpg')}}") no-repeat;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: cover;
            background-position: center;
        }

    </style>
</head>

<body>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>Oops!</h1>
            </div>
            <h2>404 - Page non trouvé</h2>
            <p>La page que vous recherchez a peut-être été supprimée ou a changé de nom ou est temporairement
                indisponible.</p>
            <a href="{{ route('index') }}">Revenir au page d'acceuil</a>
        </div>
    </div>

</body>

</html>
