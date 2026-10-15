<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #aec6e6, #8fb3e4);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 0.8fr 1.2fr;
            align-items: center;
            gap: 35px;
        }

        h1 {
            font-size: 34px;
            line-height: 1.3;
            color: #172b49;
        }

        p {
            font-size: 17px;
            line-height: 1.7;
            color: #26374d;
        }

        .btn-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            margin-top: 20px;
            margin-left: auto;
            border-radius: 50%;
            background: #2878d0;
            color: white;
            font-size: 27px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-arrow:hover {
            background: #1c5fa8;
            transform: translateX(3px);
        }

        @media (max-width: 650px) {
            .container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            h1 {
                font-size: 30px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <main class="container">
        <h1>Selamat Datang di Aplikasi Sertifikasi</h1>

        <section>
            <p>
                Ini adalah sistem pengelolaan sertifikasi berbasis web
                yang dirancang untuk memudahkan proses administrasi dan
                manajemen sertifikasi. Sistem ini menyediakan fitur
                untuk mengelola data peserta, skema sertifikasi, dan
                proses sertifikasi secara efisien.
            </p>

            <a href="{{ route('login') }}"
               class="btn-arrow"
               aria-label="Masuk ke halaman login">
                >>
            </a>
        </section>
    </main>

</body>
</html>
