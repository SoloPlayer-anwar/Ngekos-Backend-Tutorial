@extends('layouts.bootstrap')

@section('title')
Edit Fasilitas
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Edit {{$fasilitas->name_fasilitas}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('fasilitas.update', [$fasilitas->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name_fasilitas">Name Fasilitas</label>
                            <input type="text" class="form-control {{$errors->first('name_fasilitas') ? 'is-invalid' : ''}}" name="name_fasilitas" id="name_fasilitas" placeholder="Silahkan isi Nama Fasilitas" value="{{$fasilitas->name_fasilitas}}">
                            <span class="error invalid-feedback">{{$errors->first('name_fasilitas')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="photo_dapur">Photo Dapur</label>
                            <div class="input-group">
                                <img src="{{$fasilitas->photo_dapur}}" width="40px" height="40px" alt="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="photo_dapur"></label>
                            <input type="file" class="form-control {{$errors->first('photo_dapur') ? 'is-invalid' : ''}}"
                            name="photo_dapur" id="photo_dapur">
                            <span class="error invalid-feedback">{{$errors->first('photo_dapur')}}</span>
                          </div>


                          <div class="form-group">
                            <label for="photo_ruangan">Photo Ruangan</label>
                            <div class="input-group">
                                <img src="{{$fasilitas->photo_ruangan}}" width="40px" height="40px" alt="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="photo_ruangan"></label>
                            <input type="file" class="form-control {{$errors->first('photo_ruangan') ? 'is-invalid' : ''}}"
                            name="photo_ruangan" id="photo_ruangan">
                            <span class="error invalid-feedback">{{$errors->first('photo_ruangan')}}</span>
                          </div>


                          <div class="form-group">
                            <label for="photo_kamar">Photo Kamar</label>
                            <div class="input-group">
                                <img src="{{$fasilitas->photo_kamar}}" width="40px" height="40px" alt="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="photo_kamar"></label>
                            <input type="file" class="form-control {{$errors->first('photo_kamar') ? 'is-invalid' : ''}}"
                            name="photo_kamar" id="photo_kamar">
                            <span class="error invalid-feedback">{{$errors->first('photo_kamar')}}</span>
                          </div>

                        <button type="submit" class="btn btn-primary mx-auto">Update Fasilitas</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
