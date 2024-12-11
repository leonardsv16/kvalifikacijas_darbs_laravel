<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}" />
    <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <style>
        body {
            background-color: #f4f7fc;
            background-image: url(/img/first-bg.png);
            height: 100vh;
            margin: 0;
        }

        .container {
            margin-top: 80px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        .table {
            background: white;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #b02a37;
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

            @auth
                <li class="nav__item">
                    <a href="/tasks" class="nav__link c-yellow scrolly"><img src="img/about-icon.png" alt="" /></a>
                </li>
                <li class="nav__item">
                    <a href="/projects" class="nav__link c-red"><img src="img/projects-icon.png" alt="" /></a>
                </li>
            @endauth

            <li class="nav__item">
                <a href="/contacts" class="nav__link c-green"><img src="img/contact-icon.png" alt="" /></a>
            </li>
        </ul>
    </nav>


    <div class="container">
        <h1>Manage Users</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/vendor/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
