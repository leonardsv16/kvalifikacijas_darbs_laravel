<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Contact Us</title>
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


    <section class="panel b-green" id="4">
        <article class="panel__wrapper">
            <div class="panel__content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="contact-content">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                                <div class="heading">
                                    <h4>Contact us</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="contat-form">
                                        <form id="contact" action="{{ route('contact.submit') }}" method="POST">
                                                @csrf
                                                <fieldset>
                                                    <input name="name" type="text" class="form-control" id="name"
                                                        placeholder="Your Name" required="" />
                                                </fieldset>
                                                <fieldset>
                                                    <input name="email" type="email" class="form-control" id="email"
                                                        placeholder="Email" required="" />
                                                </fieldset>
                                                <fieldset>
                                                    <textarea name="message" rows="6" class="form-control" id="message"
                                                        placeholder="Message" required=""></textarea>
                                                </fieldset>
                                                <fieldset>
                                                    <button type="submit" id="form-submit" class="btn">
                                                        Send Message
                                                    </button>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="more-info">
                                            <p>
                                                ..
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
