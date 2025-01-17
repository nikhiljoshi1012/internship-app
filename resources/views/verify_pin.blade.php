<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify PIN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        .card-header {
            background-color: #203a43;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 15px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #2c5364;
            box-shadow: 0 0 6px rgba(44, 83, 100, 0.5);
        }

        .btn-primary {
            background-color: #203a43;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #182c34;
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <i class="fas fa-unlock-alt"></i> Verify PIN
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('verify.pin') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="pin" class="form-label">{{ __('Enter PIN') }}</label>
                    <input id="pin" type="password" class="form-control @error('pin') is-invalid @enderror" name="pin"
                        required>
                    @error('pin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>