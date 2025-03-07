<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body class="container mt-5">

    <h1 class="text-center mb-5"><mark>"Project Calculator"</mark></h1>

    <form id="calculatorForm" class="p-4 border rounded bg-light">
        @csrf

        <label for="angka1" class="form-label fw-bold">Bilangan 1</label>
        <input type="number" step="any" id="angka1" name="angka1" class="form-control mb-3" placeholder="Masukkan Angka" autocomplete="off" required>

        <label for="operasi" class="form-label fw-bold">Operator (+, -, *, /, %, ^)</label>
        
        <select id="operasi" name="operasi" class="form-select mb-3" required>
            <option value="" disabled selected>Pilih operator</option>
            <option value="tambah">Tambah (+)</option>
            <option value="kurang">Kurang (-)</option>
            <option value="kali">Kali (*)</option>
            <option value="bagi">Bagi (/)</option>
            <option value="modulo">Modulo (%)</option>
            <option value="pangkat">Pangkat (^)</option>
        </select>

        <label for="angka2" class="form-label fw-bold">Bilangan 2</label>
        <input type="number" step="any" id="angka2" name="angka2" class="form-control mb-3" placeholder="Masukkan Angka" autocomplete="off" required>

        <button type="submit" class="btn btn-primary ">Hitung</button>
        <button type="button" id="btn-reset" class="btn btn-danger ms-2">Reset</button>
    </form>

    <div id="hasil" class="mt-4 p-3 border rounded bg-white;">
        <h2 class="fw-bold">Hasil:</h2>
        <p class="fs-4" id="hasilValue"></p>
    </div>

    <script>
        $(document).ready(function() {
            $('#calculatorForm').submit(function(e) {
                e.preventDefault(); 

                let angka1 = $('#angka1').val();
                let angka2 = $('#angka2').val();
                let operasi = $('#operasi').val();
                let _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '/calculate',
                    method: 'POST',
                    data: {
                        angka1: angka1,
                        angka2: angka2,
                        operasi: operasi,
                        _token: _token
                    },
                    success: function(response) {
                        $('#hasilValue').text(response.hasil);
                        $('#hasil');
                    }
                });
            });
            $('#btn-reset').click(function() {
                $.ajax({
                    url: '/reset',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#angka1').val('');
                        $('#angka2').val('');
                        $('#operasi').val('');
                        $('#hasilValue').text('');
                    }
                });
            });
        });
    </script>

</body>

</html>
