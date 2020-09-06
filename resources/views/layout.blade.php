<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vegan QA</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon_io/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon_io/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon_io/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon_io/site.webmanifest')}}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <img src="{{asset('favicon_io/favicon.ico')}}" width="30" height="30" class="d-inline-block align-top" alt="vegan icon" >
            Vegan QA <span class="sr-only">(current)</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{Request::is('questions') ? 'active' : '' }} ">
                    <a class="nav-link" href="/questions">View questions</a>
                </li>
                <li class="nav-item {{Request::is('questions/create') ? 'active' : '' }} ">
                    <a class="nav-link" href="{{route('questions.create')}}">Ask a question</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1 class="mt-3">@yield ('header')</h1>
        @yield ('content')
    </div>
</body>

</html>