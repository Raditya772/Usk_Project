{{-- <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Peserta Sertifikasi</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            color: #1f2937;
        }

        .container {
            max-width: 900px;
            margin: 25px auto;
            background: rgba(255, 255, 255, 0.92);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 16px 36px rgba(37, 99, 235, 0.12);
        }
        .card {
            max-width: 900px;
            margin: 0 auto 25px;
            padding: 24px 40px;
            background: rgba(255, 255, 255, 0.92);
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.08);
        }
        .student-list {
            margin: 0;
            padding-left: 20px;
        }
        .student-list li {
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .student-list li:last-child {
            border-bottom: 0;
        }
        h1 {
            font-size: 2.2rem;
            margin-bottom: 30px;
        }

        p {
            font-size: 1.06rem;
            line-height: 1.7;
            color: #4b5563;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .nav {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="nav">
            @guest
                <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Registrasi</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endguest
        </div>

        <h1>Pengelolaan Data Peserta Sertifikasi</h1>
        <h3>Kelola data peserta dan skema sertifikasi siswa.</h3>
    </div>
    <section class="card">
        <h2>Peserta Terbaru</h2>
        @if ($students->isNotEmpty())
            <ul class="student-list">
                @foreach ($students as $student)
                    <li>{{ $student->name }} - {{ $student->major }}</li>
                @endforeach
            </ul>
        @else
            <p>Belum ada data peserta.</p>
        @endif
    </section>

</body>

</html> --}}
