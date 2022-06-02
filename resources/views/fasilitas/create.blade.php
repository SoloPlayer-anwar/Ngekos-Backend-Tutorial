@extends('layouts.bootstrap')

@section('title')
Create Data Fasilitas
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Fasilitas</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('fasilitas.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name_fasilitas">Name Fasilitas</label>
                    <input type="text" class="form-control {{$errors->first('name_fasilitas') ? 'is-invalid' : ''}}" name="name_fasilitas" id="name_fasilitas" placeholder="Enter name kota" value="{{ old('name_fasilitas') }}">
                    <span class="error invalid-feedback">{{$errors->first('name_fasilitas')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="photo_dapur">Photo Dapur</label>
                    <input type="file" class="form-control {{$errors->first('photo_dapur') ? 'is-invalid' : ''}}"
                    name="photo_dapur" id="photo_dapur">
                    <span class="error invalid-feedback">{{$errors->first('photo_dapur')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="photo_ruangan">Photo Ruangan</label>
                    <input type="file" class="form-control {{$errors->first('photo_ruangan') ? 'is-invalid' : ''}}"
                    name="photo_ruangan" id="photo_ruangan">
                    <span class="error invalid-feedback">{{$errors->first('photo_ruangan')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="photo_kamar">Photo Kamar</label>
                    <input type="file" class="form-control {{$errors->first('photo_kamar') ? 'is-invalid' : ''}}"
                    name="photo_kamar" id="photo_kamar">
                    <span class="error invalid-feedback">{{$errors->first('photo_kamar')}}</span>
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
