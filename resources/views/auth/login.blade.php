<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .box {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 32px;
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .remember-field {
            margin: 0 0 16px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            font-weight: 400;
        }

        .remember-label input {
            width: auto;
            margin: 0;
        }

        .btn {
            width: 100%;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            font-weight: 600;
        }

        .register-link {
            margin: 16px 0 0;
            color: #4b5563;
            text-align: center;
            font-size: 14px;
        }

        .register-link a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                
            </div>

            <div class="remember-field">
                <label class="remember-label" for="remember">
                    <input type="checkbox" name="remember" id="remember" value="1"> Ingat saya
                </label>
            </div>

            <button type="submit" class="btn">Masuk</button>
        </form>
        <p class="register-link">Belum punya akun? <a href="{{ route('register') }}">Registrasi</a></p>
    </div>
</body>

</html>
