<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CalculatorController::class, 'index']);

Route::post('/calculate', [CalculatorController::class, 'calculate']);

/*
    Alur Kerja (Untuk CalculatorController.php):
    1. Saat user mengakses web ini, rute akan mengarahkan ke get, yang mana rute yang akan dituju adalah index pada class CalculatorController
        (jadi, tampilan defaultnya adalah di view calculator (yang mana ini mengarahkan ke tampilan calculator.blade.php))
    2. Proses kalkulasi dilakukan dgn metode post, yang mana form akan dilempar ke class CalculatorController (/calculate)
    3. Di public function calculate, pertama-tama akan dilakukan validasi terlebih dahulu dari form yang telah dikirim (disini pakai @csrf agar tidak terjadi serangan dari user yg tokennya ga sah), 
        - angka1 dan angka2 harus diisi, dan harus numerik (angka)
        - operasi juga harus diisi, dan yang diinput harus operator yang ada di opsi yang tersedia.
        - bila tidak sesuai dengan yang divalidasi, maka akan muncul pesan kustom error.
    4. Setelah melewati tahap validasi, variabel $angka1 akan menyimpan hasil request dari nilai angka1 yang dikirimkan dari form
        , begitu pula untuk variabel $angka2 dan variabel $operasi, yang mana mereka akan menyimpan nilai request
    5. selanjutnya, untuk operasi, menggunakan switch case (berdasarkan input variabel $operasi)
        , dan hasil dari operasi akan disimpan kedalam variabel $hasil
    6. Setelah switch case selesai, maka function calculate ini akan return ke tampilan view(calculator)
        , beserta value" yang menggunakan compact seperti hasil, angka1, angka2, dan operasinya agar tidak hilang setelah diklik 'Hitung'
    
    Alur Kerja (Untuk calculator.blade.php):
    1. Metode yang digunakan oleh form ini adalah post, yang mana form ini akan dilempar ke rute /calculate (yang berarti akan diproses di function calculate). Kemudian, untuk keamanan form ini, menggunakan @csrf
    2. Di sini, user perlu memasukkan input dari setiap label yang ada dengan rincian sebagai berikut:
        - angka1 dan angka2:  tipe inputnya harus berupa angka, dengan atributnya juga step="any", agar bisa menerima desimal koma(.) dengan kelipatan berapapaun. kemudian, untuk valuenya, dia akan mengambil nilai dari variabel $angka1 dan $angka2 (jika sudah ada input sebelumnya) dengan old. Jika belum ada valuenya, maka kosong (''). Nilai yang akan diolah adalah yang terdapat di name="angka1" atau name="angka2"
        - operasi: disini, ada beberapa nilai opsi yang dapat dipilih. Untuk defaultnya adalah disabled dengan tulisan Pilih operator (dengan disabled/tidak dapat dipilih). Untuk yang opsi disabled itu, jika nilai sebelumnya tidak ada(user belum memilih opsi), maka value yang selected adalah kosong(''). Sedangkan untuk sisa opsinya adalah berupa operator untuk melakukan operasi aritmatika. Mereka semua valuenya adalah namanya sesuai operator, misal "tambah", "kurang", dll yang akan dikirimkan bersamaan dengan form untuk nantinya diolah di fungsi calculate yang merequest nilai" tersebut. Lalu, mereka juga menyimpan nilai lama mereka (old) agar berada di opsi selected ketika halaman kembali menampilkan view
    3. Terakhir, bila variabel $hasil ada, maka dia akan menampilkan nilai hasil yang terkandung dari variabel $hasil tersebut


*/
