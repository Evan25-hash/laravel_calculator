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
            'operasi' => 'required|in:tambah,kurang,kali,bagi,modulo,pangkat',
            ]
            ,
            [
            'angka1.required' => 'Bilangan 1 wajib diisi',
            'angka1.numeric' => 'Bilangan 1 harus berupa angka',
            'angka2.required' => 'Bilangan 2 wajib diisi',
            'angka2.numeric' => 'Bilangan 2 harus berupa angka',
            'operasi.required' => 'Operator harus diisi',
            'operasi.in' => 'Operator tidak valid',
            ]);

        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $operasi = $request->operasi;

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

        if ($request->ajax()) {
            return response()->json([
                'hasil' => $hasil,
                'angka1' => $angka1,
                'angka2' => $angka2,
                'operasi' => $operasi,
            ]);
        }    

        return view('calculator', compact('hasil', 'angka1', 'angka2', 'operasi'));
    }

    public function reset()
    {
        return response()->json([
            'angka1' => '',
            'angka2' => '',
            'operasi' => '',
            'hasil' => null
        ]);
    }
}
