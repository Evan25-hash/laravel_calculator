<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 class="text-center mb-4">Project Calculator</h1>

    <form action="/calculate" method="POST" class="p-4 border rounded bg-light">
        @csrf
    
        <label for="angka1" class="form-label fw-bold">Bilangan 1</label>
        <input type="number" step = "any" name="angka1" class="form-control mb-3" value="{{ old('angka1', $angka1 ?? '') }}" placeholder="Masukkan Angka" autocomplete="off" required>
    
        <label for="operasi" class="form-label fw-bold">Operator (+, -, *, /, %, ^)</label>
        <select name="operasi" class="form-select mb-3" required>
            <option value="" disabled {{ old('operasi', $operasi ?? '') == '' ? 'selected' : '' }}>Pilih operator</option>
            <option value="tambah" {{ old('operasi', $operasi ?? '') == 'tambah' ? 'selected' : '' }}>Tambah (+)</option>
            <option value="kurang" {{ old('operasi', $operasi ?? '') == 'kurang' ? 'selected' : '' }}>Kurang (-)</option>
            <option value="kali" {{ old('operasi', $operasi ?? '') == 'kali' ? 'selected' : '' }}>Kali (*)</option>
            <option value="bagi" {{ old('operasi', $operasi ?? '') == 'bagi' ? 'selected' : '' }}>Bagi (/)</option>
            <option value="modulo" {{ old('operasi', $operasi ?? '') == 'modulo' ? 'selected' : '' }}>Modulo (%)</option>
            <option value="pangkat" {{ old('operasi', $operasi ?? '') == 'pangkat' ? 'selected' : '' }}>Pangkat (^)</option>
        </select>

        <label for="angka2" class="form-label fw-bold">Bilangan 2</label>
        <input type="number" step = "any" name="angka2" class="form-control mb-3" value="{{ old('angka2', $angka2 ?? '') }}" placeholder="Masukkan Angka" autocomplete="off" required>
    
        <button type="submit" class="btn btn-primary">Hitung</button>
        
        <a href="/" class="btn btn-danger ms-2">Reset</a>
    </form>
    
    @if(isset($hasil))
        <div class="mt-4 p-3 border rounded bg-white">
            <h2 class="fw-bold">Hasil:</h2>
            <p class="fs-4">{{ $hasil }}</p>
        </div>
    @endif

</body>

</html>
