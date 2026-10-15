<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
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

        .btn {
            width: 100%;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            font-weight: 600;
        }

        .link {
            margin-top: 16px;
            text-align: center;
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
        <h1>Registrasi</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

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
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Daftar</button>
        </form>

        <div class="link">
            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>
    </div>
</body>

</html>
