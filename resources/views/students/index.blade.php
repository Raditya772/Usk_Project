<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta</title>
    <style>
        body {
            margin: 24px;
            color: #222;
            font: 15px Arial, sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .topbar,
        .search-bar form,
        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar {
            justify-content: space-between;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .search-bar {
            margin-bottom: 16px;
        }

        .search-bar input {
            flex: 1;
            min-width: 0;
            padding: 8px;
        }

        .btn,
        .btn-small {
            padding: 7px 10px;
            color: #222;
            font: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .table-wrap {
            overflow-x: auto;
            margin-top: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 9px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .alert {
            margin-bottom: 16px;
            color: #245b30;
        }

        .empty {
            padding: 20px;
            color: #666;
            text-align: center;
        }

        @media (max-width: 600px) {
            body {
                margin: 16px 12px;
            }

            .topbar {
                align-items: flex-start;
            }

            .search-bar form {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="topbar">
            <h1>Data Peserta</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="search-bar">
            <form method="GET" action="{{ route('students.index') }}" style="display:flex; width:100%; gap:10px;">
                <input type="text" name="search" value="{{ old('search', $search ?? '') }}"
                    placeholder="Cari nama, identitas, instansi, email, atau skema...">
                <button type="submit" class="btn">Cari</button>
                @if (request('search'))
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </form>
        </div>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Peserta</a>
        @endif

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Asal Sekolah</th>
                        <th>Email</th>
                        <th>Skema Sertifikasi</th>
                        @if (auth()->user()->isAdmin())
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $students->firstItem() + $loop->index }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->major }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->certificationScheme?->name ?? 'Belum dipilih' }}</td>
                            @if (auth()->user()->isAdmin())
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('students.show', $student) }}" class="btn-small">Detail</a>
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn-small edit">Edit</a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-small delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" class="empty">Belum ada data peserta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($students->hasPages())
            <div class="pagination">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</body>

</html>
