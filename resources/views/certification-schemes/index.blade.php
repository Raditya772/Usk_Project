<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Skema Sertifikasi</title>
    <style>
        body {
            margin: 0;
            padding: 28px 16px;
            background: #f4f7f5;
            color: #17211d;
            font: 15px Arial, sans-serif;
        }

        main {
            max-width: 1100px;
            margin: 0 auto;
        }

        .topbar,
        .actions,
        .search-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar {
            justify-content: space-between;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .search-form {
            margin: 16px 0;
        }

        input {
            flex: 1;
            min-width: 0;
            padding: 10px;
            border: 1px solid #b9c8bf;
            border-radius: 5px;
            font: inherit;
        }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            border: 0;
            border-radius: 5px;
            background: #176b52;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
        }

        .btn-secondary {
            background: #e6eee9;
            color: #17211d;
        }

        .table-wrap {
            overflow-x: auto;
            background: #fff;
            border: 1px solid #dce5df;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e2e9e4;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #eaf1ec;
        }

        .actions form {
            margin: 0;
        }

        .alert {
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 5px;
            background: #e8f4ec;
            color: #20563c;
        }

        .alert-error {
            background: #fff0e9;
            color: #873a21;
        }

        .empty {
            padding: 24px;
            color: #607168;
            text-align: center;
        }

        @media (max-width: 600px) {
            .topbar {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .search-form {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <main>
        <div class="topbar">
            <h1>Data Skema Sertifikasi</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <a href="{{ route('certification-schemes.create') }}" class="btn">Tambah Skema</a>
        <form method="GET" action="{{ route('certification-schemes.index') }}" class="search-form">
            <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Cari kode atau nama skema">
            <button type="submit" class="btn">Cari</button>
            @if (request('search'))
                <a href="{{ route('certification-schemes.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Skema</th>
                        <th>Deskripsi</th>
                        <th>Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schemes as $scheme)
                        <tr>
                            <td>{{ $scheme->code }}</td>
                            <td>{{ $scheme->name }}</td>
                            <td>{{ $scheme->description ?: '-' }}</td>
                            <td>{{ $scheme->students_count }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('certification-schemes.edit', $scheme) }}"
                                        class="btn btn-secondary">Ubah</a>
                                    <form action="{{ route('certification-schemes.destroy', $scheme) }}" method="POST"
                                        onsubmit="return confirm('Hapus skema ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-secondary">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">Belum ada skema sertifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($schemes->hasPages())
            <div>{{ $schemes->links() }}</div>
        @endif
    </main>
</body>

</html>
