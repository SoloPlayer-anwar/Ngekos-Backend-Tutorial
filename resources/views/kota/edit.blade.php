@extends('layouts.bootstrap')

@section('title')
Edit Kota
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Edit {{$kota->nama_kota}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('kota.update', [$kota->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nama_kota">Name Kota</label>
                            <input type="text" class="form-control {{$errors->first('nama_kota') ? 'is-invalid' : ''}}" name="nama_kota" id="nama_kota" placeholder="Silahkan isi Nama kota" value="{{$kota->nama_kota}}">
                            <span class="error invalid-feedback">{{$errors->first('nama_kota')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="photo_kota">Photo Kota</label>
                            <div class="input-group">
                                <img src="{{$kota->photo_kota}}" width="40px" height="40px" alt="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="photo_kota"></label>
                            <input type="file" class="form-control {{$errors->first('photo_kota') ? 'is-invalid' : ''}}"
                            name="photo_kota" id="photo_kota">
                            <span class="error invalid-feedback">{{$errors->first('photo_kota')}}</span>
                          </div>

                        <button type="submit" class="btn btn-primary mx-auto">Update Kota Kategori</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
