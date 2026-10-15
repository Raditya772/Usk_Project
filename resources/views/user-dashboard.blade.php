<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User | Sertifikasi</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: #f2f6f3;
            color: #18241e;
            font-family: Arial, sans-serif;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px clamp(20px, 6vw, 80px);
            background: #183d32;
            color: #fff;
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
        }

        .logout button {
            padding: 9px 12px;
            border: 1px solid #a9c8b8;
            border-radius: 5px;
            background: transparent;
            color: #fff;
            font: inherit;
            cursor: pointer;
        }

        main {
            width: min(100% - 40px, 760px);
            margin: 52px auto;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .welcome {
            margin: 0 0 28px;
            color: #617168;
        }

        .profile {
            padding: 22px;
            border: 1px solid #d9e4dc;
            border-radius: 6px;
            background: #fff;
        }

        .participants h2 {
            margin: 0;
            font-size: 17px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        .count,
        .muted {
            color: #617168;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 11px 8px;
            border-top: 1px solid #e6ece8;
            text-align: left;
            white-space: nowrap;
        }

        th {
            color: #617168;
            font-size: 12px;
            font-weight: 600;
        }

        .all-participants {
            display: inline-block;
            margin-top: 16px;
            color: #176b52;
            font-weight: 700;
            text-decoration: none;
        }

        @media (max-width: 480px) {
            header {
                padding: 16px 20px;
            }

            main {
                margin-top: 32px;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="brand">Daftar Peserta</div>
        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </header>
    <main>
        <h1>Dashboard User</h1>
        <p class="welcome">Selamat datang, {{ Auth::user()->name }}.</p>
        <section class="profile participants" aria-label="Data peserta">
            <div class="section-heading">
                <h2>Peserta terbaru</h2>
                <span class="count">{{ $studentCount }} peserta terdaftar</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Skema Sertifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->certificationScheme?->name ?? 'Belum dipilih' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="muted">Belum ada data peserta.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <a href="{{ route('students.index') }}" class="all-participants">Lihat semua peserta</a>
        </section>
    </main>
</body>

</html>
