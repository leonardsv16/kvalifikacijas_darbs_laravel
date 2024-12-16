<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body>

    <nav class="nav">
        <div class="burger">
            <div class="burger__patty"></div>
        </div>

        <ul class="nav__list">
            <li class="nav__item">
                <a href="/home" class="nav__link c-blue"><img src="img/home-icon.png" alt="" /></a>
            </li>

            @auth
                <li class="nav__item">
                    <a href="/tasks" class="nav__link c-yellow scrolly"><img src="img/about-icon.png" alt="" /></a>
                </li>
                <li class="nav__item">
                    <a href="/projects" class="nav__link c-red"><img src="img/projects-icon.jpg" alt="" /></a>
                </li>
            @endauth

            <li class="nav__item">
                <a href="/contacts" class="nav__link c-green"><img src="img/contact-icon.png" alt="" /></a>
            </li>
        </ul>
    </nav>

    <section class="panel b-blue" id="1">
        <article class="panel__wrapper">
            <div class="panel__content">
                <div class="container">
                    <div class="row">
                        <div class="login-container">

                            @auth
                                <h2>Welcome, {{ auth()->user()->name }}</h2>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Logout</button>
                                </form>

                            @else
                                <h2>Login</h2>

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" required placeholder="Enter your email" />
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your password" />
                                    </div>

                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>

                                <div class="text-center">
                                    <p>Don't have an account? <a href="/register">Register here</a></p>
                                    <p><a href="/password/reset">Forgot your password?</a></p>
                                </div>
                            @endauth

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
