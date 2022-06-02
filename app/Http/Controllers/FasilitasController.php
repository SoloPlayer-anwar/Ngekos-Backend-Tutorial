<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['fasilitas'] = Fasilitas::paginate(5);

        if($filterKeyword)
        {
            $data['fasilitas'] = Fasilitas::where("name_fasilitas", "LIKE", "%$filterKeyword%")->paginate(5);
        }

        return view('fasilitas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fasilitas.create');
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
            'name_fasilitas' => 'required|string|max:255',
            'photo_dapur' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'photo_ruangan' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'photo_kamar' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        $input = $request->all();
        if($request->file('photo_dapur')->isValid())
        {
            $photoDapur = $request->file('photo_dapur');
            $extension = $photoDapur->getClientOriginalExtension();
            $fileName = "photo-dapur/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/photo-dapur";
            $request->file('photo_dapur')->move($uploadPath, $fileName);
            $input['photo_dapur'] = $fileName;
        }

        if($request->file('photo_ruangan')->isValid())
        {
            $photoRuangan = $request->file('photo_ruangan');
            $extension = $photoRuangan->getClientOriginalExtension();
            $fileName = "photo-ruangan/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/photo-ruangan";
            $request->file('photo_ruangan')->move($uploadPath, $fileName);
            $input['photo_ruangan'] = $fileName;
        }

        if($request->file('photo_kamar')->isValid())
        {
            $photoKamar = $request->file('photo_kamar');
            $extension = $photoKamar->getClientOriginalExtension();
            $fileName = "photo-kamar/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/photo-kamar";
            $request->file('photo_kamar')->move($uploadPath, $fileName);
            $input['photo_kamar'] = $fileName;
        }

        Fasilitas::create($input);
        return redirect()->route('fasilitas.index')->with('status', 'Data berhasil ditambahkan');
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
        $data['fasilitas'] = Fasilitas::findOrFail($id);
        return view('fasilitas.edit', $data);
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

        $fasilitas = Fasilitas::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name_fasilitas' => 'sometimes|string|max:255',
            'photo_dapur' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'photo_ruangan' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'photo_kamar' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:2048'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        $input = $request->all();

        if($request->hasFile('photo_dapur'))
        {
            if($request->file('photo_dapur')->isValid())
            {
                Storage::disk('upload')->delete($fasilitas->photo_dapur);
                $photoDapur = $request->file('photo_dapur');
                $extension = $photoDapur->getClientOriginalExtension();
                $fileName = "photo-dapur/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/photo-dapur";
                $request->file('photo_dapur')->move($uploadPath, $fileName);
                $input['photo_dapur'] = $fileName;
            }
        }

        if($request->hasFile('photo_ruangan'))
        {
            if($request->file('photo_ruangan')->isValid())
            {
                Storage::disk('upload')->delete($fasilitas->photo_ruangan);
                $photoRuangan = $request->file('photo_ruangan');
                $extension = $photoRuangan->getClientOriginalExtension();
                $fileName = "photo-ruangan/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/photo-ruangan";
                $request->file('photo_ruangan')->move($uploadPath, $fileName);
                $input['photo_ruangan'] = $fileName;
            }
        }

        if($request->hasFile('photo_kamar'))
        {
            if($request->file('photo_kamar')->isValid())
            {
                Storage::disk('upload')->delete($fasilitas->photo_kamar);
                $photoKamar = $request->file('photo_kamar');
                $extension = $photoKamar->getClientOriginalExtension();
                $fileName = "photo-kamar/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/photo-kamar";
                $request->file('photo_kamar')->move($uploadPath, $fileName);
                $input['photo_kamar'] = $fileName;
            }
        }

        $fasilitas->update($input);
        return redirect()->route('fasilitas.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        Storage::disk('upload')->delete($fasilitas->photo_dapur);
        Storage::disk('upload')->delete($fasilitas->photo_ruangan);
        Storage::disk('upload')->delete($fasilitas->photo_kamar);
        $fasilitas->delete();
        return redirect()->back()->with('status', 'Data berhasil di hapus');
    }
}
