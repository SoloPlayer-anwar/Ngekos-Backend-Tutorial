<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function fasilitas (Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 10);
        $name_fasilitas = $request->input('name_fasilitas');
        $show_product = $request->input('show_product');


        if($id)
        {
            $fasilitas = Fasilitas::with(['productkos'])->find($id);

            if($fasilitas)
            {
                return ResponseFormatter::success(
                    $fasilitas,
                    'Data fasilitas berhasil diambil'
                );
            }

            else {
                return ResponseFormatter::error(
                    null,
                    'Data fasilitas tidak ditemukan',
                    404
                );
            }
        }

        $fasilitas = Fasilitas::query();

        if($name_fasilitas)
        {
            $fasilitas->where('name_fasilitas', 'like', '%' .$name_fasilitas . '%');
        }

        if($show_product)
        {
            $fasilitas->with('productkos');
        }

        return ResponseFormatter::success(
            $fasilitas->paginate($limit),
            'Data fasilitas berhasil diambil'
        );
    }
}
