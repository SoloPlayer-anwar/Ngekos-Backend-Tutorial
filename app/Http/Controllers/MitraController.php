<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['mitra'] = Mitra::paginate(5);

        if($filterKeyword)
        {
            $data['mitra'] = Mitra::where("name_mitra", "LIKE", "%$filterKeyword%")->paginate(5);
        }

        return view('mitra.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['mitra'] = Mitra::findOrFail($id);
        return view('mitra.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['mitra'] = Mitra::findOrFail($id);
        return view('mitra.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataMitra = Mitra::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name_mitra' => 'required|string|max:255',
            'alamat_mitra' => 'sometimes|string|max:255',
            'phone_mitra' => 'sometimes|string|max:255',
            'photo_ktp' => 'sometimes|image|mimes:jpeg,png,jpg.gif,svg|max:2048',
            'photo_kos' => 'sometimes|image|mimes:jpeg,png,jpg.gif,svg|max:2048',
            'latitude' => 'sometimes|string|max:255',
            'longitude' => 'sometimes|string|max:255',
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $input = $request->all();

        if($request->hasFile('photo_ktp'))
        {
            if($request->file('photo_ktp')->isValid())
            {
                Storage::disk('upload')->delete($dataMitra->photo_ktp);
                $photo = $request->file('photo_ktp');
                $extensions = $photo->getClientOriginalExtension();
                $photoKtp = "mitra-photo_ktp/".date('YmdHis').".".$extensions;
                $uploadPath = env('UPLOAD_PATH')."/mitra-photo_ktp";
                $request->file('photo_ktp')->move($uploadPath, $photoKtp);
                $input['photo_ktp'] = $photoKtp;
            }
        }

        if($request->hasFile('photo_kos'))
        {
            if($request->file('photo_kos')->isValid())
            {
                Storage::disk('upload')->delete($dataMitra->photo_kos);
                $photo = $request->file('photo_kos');
                $extensions = $photo->getClientOriginalExtension();
                $photoKos = "mitra-photo_kos/".date('YmdHis').".".$extensions;
                $uploadPath = env('UPLOAD_PATH')."/mitra-photo_kos";
                $request->file('photo_kos')->move($uploadPath, $photoKos);
                $input['photo_kos'] = $photoKos;
            }
        }

        $dataMitra->update($input);
        return redirect()->route('mitra.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataMitra = Mitra::findOrFail($id);
        Storage::disk('upload')->delete($dataMitra->photo_ktp);
        Storage::disk('upload')->delete($dataMitra->photo_kos);
        $dataMitra->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
    }
}
