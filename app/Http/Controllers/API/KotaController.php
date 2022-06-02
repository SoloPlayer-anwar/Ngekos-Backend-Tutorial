<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function kota (Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 10);
        $nama_kota = $request->input('nama_kota');
        $show_product = $request->input('show_product');


        if($id)
        {
            $kota = Kota::with(['productkos'])->find($id);


            if($kota)
            {
                return ResponseFormatter::success(
                    $kota,
                    'Data kategori kota berhasil diambil'
                );
            }

            else {
                return ResponseFormatter::error(
                    null,
                    'Data kategori kota tidak ditemukan',
                    404
                );
            }
        }

        $kota = Kota::query();

        if($nama_kota)
        {
            $kota->where('nama_kota', 'like', '%' .$nama_kota . '%');
        }

        if($show_product)
        {
            $kota->with('productkos');
        }

        return ResponseFormatter::success(
            $kota->paginate($limit),
            'Data kategori kota berhasil diambil'
        );
    }
}
