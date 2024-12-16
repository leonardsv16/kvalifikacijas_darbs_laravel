<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="nav">
        <div class="burger">
            <div class="burger__patty"></div>
        </div>

        <ul class="nav__list">
            <li class="nav__item">
                <a href="{{ route('home') }}" class="nav__link c-blue"><img src="{{ asset('img/home-icon.png') }}" alt="Home" /></a>
            </li>
            <li class="nav__item">
                <a href="{{ route('tasks.index') }}" class="nav__link c-yellow scrolly"><img src="{{ asset('img/about-icon.png') }}" alt="Tasks" /></a>
            </li>
            <li class="nav__item">
                <a href="{{ route('projects.index') }}" class="nav__link c-red"><img src="{{ asset('img/projects-icon.jpg') }}" alt="Projects" /></a>
            </li>
            <li class="nav__item">
                <a href="{{ route('contacts.index') }}" class="nav__link c-green"><img src="{{ asset('img/contact-icon.png') }}" alt="Contacts" /></a>
            </li>
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="{{ asset('js/vendor/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
