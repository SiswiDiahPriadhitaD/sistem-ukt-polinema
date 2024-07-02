<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} - Forgot Password</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- iziToast CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
        }

        .container {
            display: flex;
            width: 80%;
            height: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .split-left {
            background: url('assets/img/avatar/lupa-password.png') no-repeat center center;
            background-size: cover;
            background-position-x: center;
            background-position-y: bottom;
            flex: 1;
        }

        .split-right {
            background-color: white;
            color: white;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-form {
            max-width: 300px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        .login-form h4 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .login-form .form-control {
            border-radius: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .login-form .form-control:focus {
            border-color: #0075FF;
            box-shadow: 0 0 8px rgba(0, 117, 255, 0.2);
        }

        .login-form .btn-primary {
            background-color: #0075FF;
            border-color: #0075FF;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .login-form .btn-primary:hover {
            background-color: #005bb5;
            border-color: #005bb5;
        }

        .login-form .form-group {
            margin-bottom: 15px;
        }

        .login-form .text-muted a {
            color: #0075FF;
        }

        .login-form .text-muted a:hover {
            color: #005bb5;
        }

        .login-form .simple-footer {
            text-align: center;
            margin-top: 20px;
            color: #858796;
        }

        .text-muted {
            color: black !important;
        }

        .login-form .text-muted a {
            color: #0075FF !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media (max-width: 767.98px) {
            .container {
                flex-direction: column;
                height: auto;
                width: 90%;
            }

            .split-left {
                display: none;
            }

            .split-right {
                flex: 1;
                width: 100%;
            }

            .login-form {
                max-width: 100%;
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container" style="padding-left: 0px !important;padding-right: 0px !important">
        <div class="split-left"></div>
        <div class="split-right">
            <div class="login-form">
                <h4 class="text-primary">Forgot Password</h4>
                <p style="color: black">We will send a link to reset your password</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold text-uppercase text-primary">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Enter your email">

                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                </form>
                <div class="mt-5 text-muted text-center">
                    Remembered your password? <a href="/login">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6Hjty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorElements = document.getElementsByClassName('form-error-message');
            if (errorElements.length > 0) {
                for (var i = 0; i < errorElements.length; i++) {
                    var errorMessage = errorElements[i].getAttribute('data-error');
                    if (errorMessage) {
                        console.log(errorMessage);
                        iziToast.error({
                            title: 'Error',
                            message: errorMessage,
                            position: 'topRight'
                        });
                    }
                }
            }
        });
    </script>
</body>

</html>
