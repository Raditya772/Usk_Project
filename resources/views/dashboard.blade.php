<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sertifikasi</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f6f3;
            color: #18241e;
        }

        .layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            padding: 26px 18px;
            background: #183d32;
            color: #fff;
        }

        .brand {
            padding: 0 12px 28px;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.4;
        }

        .brand span {
            display: block;
            margin-top: 5px;
            color: #a9c8b8;
            font-size: 12px;
            font-weight: 400;
        }

        .nav-label {
            padding: 0 12px;
            margin-bottom: 8px;
            color: #a9c8b8;
            font-size: 11px;
            text-transform: uppercase;
        }

        .menu {
            display: grid;
            gap: 5px;
        }

        .menu a,
        .logout button {
            width: 100%;
            display: block;
            padding: 11px 12px;
            border: 0;
            border-radius: 5px;
            background: transparent;
            color: #e6f0ea;
            text-align: left;
            text-decoration: none;
            font: inherit;
            cursor: pointer;
        }

        .menu a:hover,
        .menu a.active,
        .logout button:hover {
            background: #2a5949;
            color: white;
        }

        .logout {
            margin-top: auto;
            padding-top: 24px;
            border-top: 1px solid #39614f;
        }

        main {
            min-width: 0;
            padding: 42px clamp(20px, 5vw, 68px);
        }

        .heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .heading h1 {
            margin: 0 0 6px;
            font-size: 26px;
        }

        .heading p {
            margin: 0;
            color: #617168;
        }

        .metrics {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            max-width: 720px;
        }

        .metric {
            padding: 18px;
            border: 1px solid #d9e4dc;
            border-radius: 6px;
            background: #fff;
        }

        .metric span {
            display: block;
            color: #617168;
            font-size: 14px;
        }

        .metric strong {
            display: block;
            margin-top: 8px;
            color: #183d32;
            font-size: 26px;
        }

        @media (max-width: 700px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                padding: 16px;
            }

            .brand {
                padding: 0 4px 14px;
            }

            .nav-label {
                display: none;
            }

            .menu {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .logout {
                padding-top: 10px;
                margin-top: 10px;
            }

            .logout button {
                padding-left: 4px;
            }

            main {
                padding: 28px 18px;
            }
        }

        @media (max-width: 420px) {
            .metrics {
                grid-template-columns: 1fr;
            }

            .heading {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="brand">Sertifikasi<span>Panel Administrator</span></div>
            <div class="nav-label">Menu Utama</div>
            <nav class="menu" aria-label="Navigasi utama">
                <a href="{{ route('dashboard') }}" class="active" aria-current="page">Dashboard</a>
                <a href="{{ route('students.index') }}"> Peserta</a>
                <a href="{{ route('certification-schemes.index') }}">Skema </a>
            </nav>
            <form class="logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Keluar dari aplikasi</button>
            </form>
        </aside>

        <main>
            <header class="heading">
                <div>
                    <h1>Dashboard</h1>
                    <p>Selamat datang, {{ Auth::user()->name }}.</p>
                </div>
            </header>

            <section class="metrics" aria-label="Ringkasan data">
                <div class="metric"><span>Total peserta</span><strong>{{ $studentCount }}</strong></div>
                <div class="metric"><span>Skema sertifikasi</span><strong>{{ $schemeCount }}</strong></div>
            </section>
        </main>
    </div>
</body>

</html>
