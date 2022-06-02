<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $filterLevel = $request->get('role');
        $data['users'] = User::paginate(5);

        if($filterKeyword)
        {
            $data['users'] = User::where("name", "LIKE", "%$filterKeyword%")
            ->where('role', $filterLevel)->paginate(5);
        }

        return view('users.index', $data);
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
        $data['users'] = User::findOrFail($id);
        return view('users.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['users'] = User::findOrFail($id);
        return view('users.edit', $data);
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
        $dataUser = User::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'jelis_kelamin' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string|max:255',
            'kota' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:255',
            'role' => 'sometimes|nullable|string|max:255',
            'avatar' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'verifikasi' => 'sometimes|nullable|string|max:255',
            'latitude' => 'sometimes|nullable|string',
            'longitude' => 'sometimes|nullable|string',
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $input = $request->all();

        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                Storage::disk('upload')->delete($dataUser->avatar);
                $avatarFile = $request->file('avatar');
                $extension = $avatarFile->getClientOriginalExtension();
                $fileName = "user-avatar/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH'). "/user-avatar";
                $request->file('avatar')->move($uploadPath, $fileName);
                $input['avatar'] = $fileName;
            }
        }

        $dataUser->update($input);
        return redirect()->route('users.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataUser = User::findOrFail($id);
        Storage::disk('upload')->delete($dataUser->avatar);
        $dataUser->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
    }
}
