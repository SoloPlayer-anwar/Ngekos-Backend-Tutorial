<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Exception;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function mitra (Request $request)
    {
        $request->validate([
            'name_mitra' => 'required|string|max:255',
            'alamat_mitra' => 'required|string|max:255',
            'phone_mitra' => 'required|string|max:255',
            'photo_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_kos' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'latitude' => '',
            'longitude' => ''
        ]);


        $mitra = Mitra::create([
            'name_mitra' => $request->name_mitra,
            'alamat_mitra' => $request->alamat_mitra,
            'phone_mitra' => $request->phone_mitra,
            'photo_ktp' => $request->photo_ktp,
            'photo_kos' => $request->photo_kos,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if($request->file('photo_ktp')->isValid())
        {
            $photo = $request->file('photo_ktp');
            $extensions = $photo->getClientOriginalExtension();
            $photoKtp = "mitra-photo_ktp/".date('YmdHis').".".$extensions;
            $uploadPath = env('UPLOAD_PATH')."/mitra-photo_ktp";
            $request->file('photo_ktp')->move($uploadPath, $photoKtp);
            $mitra['photo_ktp'] = $photoKtp;
        }

        if($request->file('photo_kos')->isValid())
        {
            $photo = $request->file('photo_kos');
            $extensions = $photo->getClientOriginalExtension();
            $photoKos = "mitra-photo_kos/".date('YmdHis').".".$extensions;
            $uploadPath = env('UPLOAD_PATH')."/mitra-photo_kos";
            $request->file('photo_kos')->move($uploadPath, $photoKos);
            $mitra['photo_kos'] = $photoKos;
        }


        try {
            $mitra->save();
            return ResponseFormatter::success(
                $mitra,
                'Mitra Berhasil mendaftar'
            );
        }

        catch(Exception $error)
        {
            return ResponseFormatter::error(
                $error->getMessage(),
                'Mitra Gagal mendaftar'
            );
        }
    }
}
