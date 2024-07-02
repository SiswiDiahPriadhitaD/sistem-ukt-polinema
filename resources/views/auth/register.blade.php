<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} - Register</title>

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
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            height: 80%;
            max-height: 700px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .split-left {
            background: url('assets/img/avatar/register.png') no-repeat center center;
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
            overflow-y: auto;
        }

        .register-form {
            max-width: 300px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        .register-form h4 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .register-form .form-control {
            border-radius: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .register-form .form-control:focus {
            border-color: #0075FF;
            box-shadow: 0 0 8px rgba(0, 117, 255, 0.2);
        }

        .register-form .btn-primary {
            background-color: #0075FF;
            border-color: #0075FF;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .register-form .btn-primary:hover {
            background-color: #005bb5;
            border-color: #005bb5;
        }

        .register-form .form-group {
            margin-bottom: 15px;
        }

        .register-form .text-muted a {
            color: #0075FF;
        }

        .register-form .text-muted a:hover {
            color: #005bb5;
        }

        .register-form .simple-footer {
            text-align: center;
            margin-top: 20px;
            color: #858796;
        }

        .text-muted {
            color: black !important;
        }

        .register-form .text-muted a {
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
                overflow-y: auto;
            }

            .register-form {
                max-width: 100%;
                width: 100%;
                padding: 20px;
            }
        }

        .invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container" style="padding-left: 0px !important; padding-right: 0px !important;">
        <div class="split-left"></div>
        <div class="split-right">
            <div class="register-form">
                <h4 class="text-primary">Register</h4>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="text-primary">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap"
                            autofocus>
                        @error('name')
                            <div class="invalid-feedback" hidden>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-primary">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan Alamat Email">
                        @error('email')
                            <div class="invalid-feedback" hidden>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="d-block text-primary">Password</label>
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password"
                            data-indicator="pwindicator">
                        @error('password')
                            <div class="invalid-feedback" hidden>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="d-block text-primary">Password Confirmation</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control" placeholder="Masukkan Konfirmasi Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Register
                        </button>
                    </div>
                </form>
                <div class="mt-5 text-muted text-center">
                    Sudah punya akun? <a href="/login">Login</a>
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
            var errorElements = document.getElementsByClassName('invalid-feedback');
            if (errorElements.length > 0) {
                for (var i = 0; i < errorElements.length; i++) {
                    var errorMessage = errorElements[i].textContent.trim();
                    if (errorMessage) {
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
