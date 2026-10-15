<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta</title>
    <style>
        body {
            margin: 0;
            padding: 32px 16px;
            background: #f4f7f5;
            color: #17211d;
            font: 15px Arial, sans-serif;
        }

        main {
            max-width: 760px;
            margin: 0 auto;
        }

        .topbar,
        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        h1 {
            margin: 0;
        }

        .panel {
            margin-top: 24px;
            background: #fff;
            padding: 24px;
            border: 1px solid #dce5df;
            border-radius: 8px;
        }

        dl {
            display: grid;
            grid-template-columns: minmax(130px, 1fr) 2fr;
            gap: 14px;
        }

        dt {
            color: #607168;
        }

        dd {
            margin: 0;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            border: 0;
            border-radius: 5px;
            background: #176b52;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-secondary {
            background: #e6eee9;
            color: #17211d;
        }

        @media (max-width: 480px) {
            dl {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            dd {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <main>
        <div class="topbar">
            <h1>Detail Peserta</h1>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <section class="panel">
            <dl>
                <dt>Nama</dt>
                <dd>{{ $student->name }}</dd>
                <dt>NISN</dt>
                <dd>{{ $student->nisn }}</dd>
                <dt>Asal Sekolah</dt>
                <dd>{{ $student->major }}</dd>
                <dt>Email</dt>
                <dd>{{ $student->email }}</dd>
                <dt>Skema Sertifikasi</dt>
                <dd>{{ $student->certificationScheme?->code }} -
                    {{ $student->certificationScheme?->name ?? 'Belum dipilih' }}</dd>
            </dl>
            @if (auth()->user()->isAdmin())
                <div class="actions">
                    <a href="{{ route('students.edit', $student) }}" class="btn">Ubah Data</a>
                </div>
            @endif
        </section>
    </main>
</body>

</html>
