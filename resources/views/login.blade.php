<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/image/Wiki.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" integrity="sha384-QV8+oaDlJKJwQ/Scnkxm5oWfsR5Zgqn1ZlW4FL4jK71ftjF8VcOGUE3NIn1QFZDv" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Login</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('loginAction') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password">
                        </div>
                        @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="remember" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-1">Forgot your password? <a href="{{route('foget.password')}}" class="text-primary">Reset Password</a></p>
                    <p class="mb-0">Don't have an account? <a href="{{ route('pageregister') }}" class="text-primary">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


</body>


