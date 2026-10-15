<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peserta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f7fb;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-bottom: 20px;
        }

        .form-group {
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
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            background: #f59e0b;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background: #6b7280;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Peserta</h1>

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nisn">NISN</label>
                <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $student->nisn) }}">
                @error('nisn')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="major">Jurusan</label>
                <input type="text" name="major" id="major" value="{{ old('major', $student->major) }}">
                @error('major')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="certification_scheme_id">Skema Sertifikasi</label>
                <select name="certification_scheme_id" id="certification_scheme_id" required>
                    <option value="">Pilih skema sertifikasi</option>
                    @foreach ($schemes as $scheme)
                        <option value="{{ $scheme->id }}" @selected(old('certification_scheme_id', $student->certification_scheme_id) == $scheme->id)>
                            {{ $scheme->code }} - {{ $scheme->name }}
                        </option>
                    @endforeach
                </select>
                @error('certification_scheme_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Update</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
