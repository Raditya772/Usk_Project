<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Skema Sertifikasi</title>
    <style>
        body {
            margin: 0;
            padding: 32px 16px;
            background: #f4f7f5;
            color: #17211d;
            font: 15px Arial, sans-serif;
        }

        main {
            max-width: 620px;
            margin: 0 auto;
            padding: 24px;
            background: white;
            border: 1px solid #dce5df;
            border-radius: 8px;
        }

        h1 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        input,
        textarea {
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            border: 1px solid #b9c8bf;
            border-radius: 5px;
            font: inherit;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: 0;
            border-radius: 5px;
            background: #176b52;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
        }

        .btn-secondary {
            background: #e6eee9;
            color: #17211d;
        }

        .error {
            margin-top: 5px;
            color: #a53225;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <main>
        <h1>Ubah Skema Sertifikasi</h1>
        <form action="{{ route('certification-schemes.update', $certificationScheme) }}" method="POST">
            @csrf @method('PUT')
            @include('certification-schemes._form')
            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="{{ route('certification-schemes.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </main>
</body>

</html>
