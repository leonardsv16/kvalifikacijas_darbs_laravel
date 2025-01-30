<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
</head>

<body>
<div class="about-content">
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


    <div class="container">
        <h1 style=color:white;>Manage Users</h1>
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
</div>
    <script src="{{ asset('js/vendor/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
