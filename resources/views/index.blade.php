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
    <link rel="stylesheet" href="css/templatemo-style.css" />
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

    <style>

        body {
            background-color: #f4f7fc;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            margin:auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            height: 50px;
            border-radius: 5px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-center {
            margin-top: 20px;
        }


        .nav__link {
            color: white;
        }

        .nav__link:hover {
            color: #f4f7fc;
        }


        .text-center a {
            font-weight: bold;
            color: black;
        }

        .text-center a:hover {
            color: #007bff;
        }
    </style>
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
            <li class="nav__item">
                <a href="/tasks" class="nav__link c-yellow scrolly"><img src="img/about-icon.png" alt="" /></a>
            </li>
            <li class="nav__item">
                <a href="/projects" class="nav__link c-red"><img src="img/projects-icon.png" alt="" /></a>
            </li>
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
                            <h2>Login</h2>


                            <form action="/login" method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery ||
            document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>');
    </script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
