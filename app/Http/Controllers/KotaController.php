<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['kota'] = Kota::paginate(5);

        if($filterKeyword)
        {
            $data['kota'] = Kota::where("nama_kota", "LIKE", "%$filterKeyword%")->paginate(5);
        }

        return view('kota.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_kota' => 'required|min:5|max:20',
            'photo_kota' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        $input = $request->all();
        if($request->file('photo_kota')->isValid())
        {
            $photoKota = $request->file('photo_kota');
            $extension = $photoKota->getClientOriginalExtension();
            $fileName = "photo-kota/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/photo-kota";
            $request->file('photo_kota')->move($uploadPath, $fileName);
            $input['photo_kota'] = $fileName;
        }

        Kota::create($input);
        return redirect()->route('kota.index')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kota'] = Kota::findOrFail($id);
        return view('kota.edit', $data);
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
        $dataKota = Kota::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'nama_kota' => 'required|string|max:255',
            'photo_kota' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:2048'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $input = $request->all();

        if($request->hasFile('photo_kota'))
        {
            if($request->file('photo_kota')->isValid())
            {
                Storage::disk('upload')->delete($dataKota->photo_kota);
                $photoKota = $request->file('photo_kota');
                $extension = $photoKota->getClientOriginalExtension();
                $fileName = "photo-kota/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/photo-kota";
                $request->file('photo_kota')->move($uploadPath, $fileName);
                $input['photo_kota'] = $fileName;
            }
        }

        $dataKota->update($input);
        return redirect()->route('kota.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataKota = Kota::findOrFail($id);
        Storage::disk('upload')->delete($dataKota->photo_kota);
        $dataKota->delete();
        return redirect()->back()->with('status', 'Data berhasil di hapus');
    }
}
