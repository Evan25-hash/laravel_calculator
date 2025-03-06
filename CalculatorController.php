<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'angka1' => 'required|numeric',
            'angka2' => 'required|numeric',
            'operasi' => 'required'
        ]);

        $angka1 = $request->input('angka1');
        $angka2 = $request->input('angka2');
        $operasi = $request->input('operasi');

        switch ($operasi) {
            case 'tambah':
                $hasil = $angka1 + $angka2;
                break;
            case 'kurang':
                $hasil = $angka1 - $angka2;
                break;
            case 'kali':
                $hasil = $angka1 * $angka2;
                break;
            case 'bagi':
                $hasil = $angka2 != 0 ? $angka1 / $angka2 : 'Error: Pembagian oleh nol';
                break;
            case 'modulo':
                $hasil = $angka2 != 0 ? $angka1 % $angka2 : 'Error: Modulo oleh nol';
                break;
            case 'pangkat':
                $hasil = pow($angka1, $angka2); 
                break;
            default:
                $hasil = 'Operasi tidak valid';
        }

        return view('calculator', compact('hasil', 'angka1', 'angka2', 'operasi'));
    }
}
