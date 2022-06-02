<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductKos;
use Illuminate\Http\Request;

class ProductKosController extends Controller
{
    public function product (Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 10);
        $name_kos = $request->input('name_kos');
        $tags_kos = $request->input('tags_kos');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $user_id = $request->input('user_id');
        $fasilitas_id = $request->input('fasilitas_id');
        $kota_id = $request->input('kota_id');


        if($id)
        {
            $productKos = ProductKos::with(['users', 'fasilitas', 'kotas'])->find($id);

            if($productKos)
            {
                return ResponseFormatter::success(
                    $productKos,
                    'Product kos ada'
                );
            }

            else {
                return ResponseFormatter::error(
                    null,
                    'Product kos tidak ditemukan',
                    404
                );
            }
        }


        $productKos = ProductKos::with(['users', 'fasilitas', 'kotas']);

        if($name_kos)
        {
            $productKos->where('name_kos', 'like', '%' .$name_kos . '%');
        }

        if($tags_kos)
        {
            $productKos->where('tags_kos', 'like', '%' .$tags_kos . '%');
        }

        if($price_from)
        {
            $productKos->where('price_kos', '>=', $price_from);
        }

        if($price_to)
        {
            $productKos->where('price_kos', '<=', $price_to);
        }

        if($user_id)
        {
            $productKos->where('user_id', $user_id);
        }

        if($fasilitas_id)
        {
            $productKos->where('fasilitas_id', $fasilitas_id);
        }

        if($kota_id)
        {
            $productKos->where('kota_id', $kota_id);
        }

        return ResponseFormatter::success(
            $productKos->paginate($limit),
            'Product Kos Berhasil diambil'
        );
    }
}
