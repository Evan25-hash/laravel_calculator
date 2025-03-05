<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 class="text-center mb-4">Project Calculator</h1>

    <form action="/calculate" method="POST" class="p-4 border rouned bg-light">
        @csrf

        <label for="angka1" class="form-label fw-bold">Bilangan 1</label>
        <input type="number" name="angka1" id="angka1" class="form-control mb-3" value="{{ old('angka1') }}" placeholder="Masukkan Angka" required>

        <label for="operasi" class="form-label fw-bold">Operator</label>
        <select name="operasi" id="operasi" class="form-select mb-3" required>
            <option value="tambah">Tambah (+)</option>
            <option value="kurang">Kurang (-)</option>
            <option value="kali">Kali (*)</option>
            <option value="bagi">Bagi (/)</option>
            <option value="modulo">Modulo (%)</option>
        </select>

        <label for="angka2" class="form-label fw-bold">Bilangan 2</label>
        <input type="number" name="angka2" id="angka2" class="form-control mb-3" value="{{ old('angka2') }}" placeholder="Masukkan Angka" required>

        <button type="submit" class="btn btn-primary">Hitung</button>
        <button type="reset" class="btn btn-danger ms-2">Reset</button>
    </form>

    @if(isset($hasil))
        <div class="mt-4 p-3 border rounded bg-white">
            <h2 class="fw-bold">Hasil:</h2>
            <p class="fs-4">{{ $hasil }}</p>
        </div>
    @endif
</body>
</html>