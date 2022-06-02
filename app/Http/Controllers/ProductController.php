<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kota;
use App\Models\ProductKos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['product'] = ProductKos::with('users', 'fasilitas', 'kotas')->paginate(5);

        if($filterKeyword)
        {
            $data['product'] = ProductKos::with('users', 'fasilitas', 'kotas')
            ->where("name_kos", "LIKE", "%$filterKeyword%")->paginate(5);

        }

        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $fasilitas = Fasilitas::all();
        $kotas = Kota::all();
        return view('product.create', compact('users', 'fasilitas', 'kotas'));
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
            'user_id' => 'sometimes|exists:users,id',
            'fasilitas_id' => 'sometimes|exists:fasilitas,id',
            'kota_id' => 'sometimes|exists:kotas,id',
            'name_kos' => 'required|string|max:255',
            'rating_kos' => 'sometimes|numeric',
            'tags_kos' => 'sometimes|string|max:255',
            'description_kos' => 'sometimes|string|max:255',
            'price_kos' => 'sometimes|numeric',
            'photo_product' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $input = $request->all();
        if($request->file('photo_product')->isValid())
        {
            $photoProduct = $request->file('photo_product');
            $extensions = $photoProduct->getClientOriginalExtension();
            $fileName = "photo-product/".date('YmdHis').".".$extensions;
            $uploadPath = env('UPLOAD_PATH'). "/photo-product";
            $request->file('photo_product')->move($uploadPath, $fileName);
            $input['photo_product'] = $fileName;
        }

        ProductKos::create($input);
        return redirect()->route('product.index')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = ProductKos::findOrFail($id);
        $data['users'] = User::all();
        $data['fasilitas'] = Fasilitas::all();
        $data['kotas'] = Kota::all();

        return view('product.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = ProductKos::findOrFail($id);
        $data['users'] = User::all();
        $data['fasilitas'] = Fasilitas::all();
        $data['kotas'] = Kota::all();

        return view('product.edit', $data);
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
        $data = ProductKos::with(['users', 'fasilitas', 'kotas'])->findOrFail($id);
        $validate = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'fasilitas_id' => 'sometimes|exists:fasilitas,id',
            'kota_id' => 'sometimes|exists:kotas,id',
            'name_kos' => 'sometimes|string|max:255',
            'rating_kos' => 'sometimes|numeric',
            'tags_kos' => 'sometimes|string|max:255',
            'description_kos' => 'sometimes|string|max:255',
            'price_kos' => 'sometimes|numeric',
            'photo_product' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $input = $request->all();
        if($request->hasFile('photo_product'))
        {

            if($request->file('photo_product')->isValid())
            {
                $photoProduct = $request->file('photo_product');
                $extensions = $photoProduct->getClientOriginalExtension();
                $fileName = "photo-product/".date('YmdHis').".".$extensions;
                $uploadPath = env('UPLOAD_PATH'). "/photo-product";
                $request->file('photo_product')->move($uploadPath, $fileName);
                $input['photo_product'] = $fileName;
            }

        }

        $data->update($input);
        return redirect()->route('product.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProductKos::findOrFail($id);
        Storage::disk('upload')->delete($data->photo_product);
        $data->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
    }
}
