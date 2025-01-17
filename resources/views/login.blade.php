<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Body Background */
        body {
            background: linear-gradient(to right, #2980b9, #6dd5fa, #ffffff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #3498db;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        /* Input Styling */
        .form-control {
            border-radius: 8px;
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0px 0px 4px rgba(52, 152, 219, 0.5);
        }

        .invalid-feedback {
            font-size: 0.9rem;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #3498db;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card {
                margin: 0 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-lock"></i> Login
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Input -->
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password Input -->
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Login Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                                </button>
                            </div>
                                                      <!-- Register Link -->
                                                        <div class="text-center mt-3">
                                                            <p class="mb-0">Don't have an account?
                                                                <a href="{{ route('register') }}" class="text-primary">Register here</a>
                                                            </p>
                                                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>