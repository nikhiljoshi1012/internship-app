<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Body Styling */
        body {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
        }

        .card-body {
            padding: 30px;
        }

        .card-header {
            text-align: center;
            background-color: #4ca1af;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 15px;
        }

        /* Form Control Styling */
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #4ca1af;
            box-shadow: 0px 0px 6px rgba(76, 161, 175, 0.5);
        }

        /* Select Dropdown */
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%234ca1af' d='M2 0L0 2h4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 0.65em auto;
            padding-right: 2.5rem;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #4ca1af;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #3a8891;
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card {
                margin: 0 15px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <i class="fas fa-user-plus"></i> Signup
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name Field -->
                <div class="form-group mb-3">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group mb-3">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group mb-3">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group mb-3">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>

                <!-- Role Selection -->
                <div class="form-group mb-3">
                    <label for="role">{{ __('Role') }}</label>
                    <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                        <option value="student">Student</option>
                        <option value="professor">Professor</option>
                    </select>
                </div>

                <!-- Register Button -->
                <div class="form-group text-center mb-0">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-user-check"></i> {{ __('Register') }}
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center mt-3">
                    <p class="mb-0">Already have an account?
                        <a href="{{ route('login') }}" class="text-primary">Login here</a>
                    </p>
                </div>
                </form>

            </form>
        </div>
    </div>
    

    <!-- Font Awesome and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>