@extends('layouts.bootstrap')

@section('title')
Create Data Kota
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Kota</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('kota.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_kota">Username</label>
                    <input type="text" class="form-control {{$errors->first('nama_kota') ? 'is-invalid' : ''}}" name="nama_kota" id="nama_kota" placeholder="Enter name kota" value="{{ old('nama_kota') }}">
                    <span class="error invalid-feedback">{{$errors->first('nama_kota')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="photo_kota">Photo Kota</label>
                    <input type="file" class="form-control {{$errors->first('photo_kota') ? 'is-invalid' : ''}}"
                    name="photo_kota" id="photo_kota">
                    <span class="error invalid-feedback">{{$errors->first('photo_kota')}}</span>
                  </div>


                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection
