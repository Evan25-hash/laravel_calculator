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
            'operasi' => 'required|in:tambah,kurang,kali,bagi,modulo',
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

        //$hasil = 0;
        switch($operasi){
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
                $hasil =  $angka2 !=0 ? $angka1 / $angka2 : 'Error: Tidak bisa membagi dengan 0';
                break;
            case 'modulo':
                $hasil = $angka1 % $angka2;
                break;
            default:
                $hasil = 'operasi tidak valid';
                break;
        }
        return view('calculator', compact('hasil'));

    }
}
