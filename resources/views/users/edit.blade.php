<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="{{ route('users.manage') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="{{ asset('js/vendor/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
</body>

</html>
