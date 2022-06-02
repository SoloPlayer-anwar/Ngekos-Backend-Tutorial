@extends('layouts.bootstrap')

@section('title')
Edit Mitra
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Edit {{$mitra->name_mitra}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('mitra.update', [$mitra->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name_mitra">Name Mitra</label>
                            <input type="text" class="form-control {{$errors->first('name_mitra') ? 'is-invalid' : ''}}" name="name_mitra" id="name_mitra" placeholder="Silahkan isi Nama Mitra" value="{{$mitra->name_mitra}}">
                            <span class="error invalid-feedback">{{$errors->first('name_mitra')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="alamat_mitra">Alamat Mitra</label>
                            <input type="text" class="form-control {{$errors->first('alamat_mitra') ? 'is-invalid' : ''}}" name="alamat_mitra" id="alamat_mitra" placeholder="Silahkan isi Alamat Mitra" value="{{$mitra->alamat_mitra}}">
                            <span class="error invalid-feedback">{{$errors->first('alamat_mitra')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone_mitra">Phone Mitra</label>
                            <input type="numeric" class="form-control {{$errors->first('phone_mitra') ? 'is-invalid' : ''}}" name="phone_mitra" id="phone_mitra"phone_mitraplaceholder="Silahkan isi Phone Mitra" value="{{$mitra->phone_mitra}}">
                            <span class="error invalid-feedback">{{$errors->first('phone_mitra')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="photo_ktp">Photo Ktp</label>
                            <div class="input-group">
                                <img src="{{$mitra->photo_ktp}}" width="40px" height="40px" alt="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="photo_ktp"></label>
                            <input type="file" class="form-control {{$errors->first('photo_ktp') ? 'is-invalid' : ''}}"
                            name="photo_ktp" id="photo_ktp">
                            <span class="error invalid-feedback">{{$errors->first('photo_ktp')}}</span>
                          </div>

                          <div class="form-group">
                            <label for="photo_kos">Photo Kos</label>
                            <div class="input-group">
                                <img src="{{$mitra->photo_kos}}" width="40px" height="40px" alt="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="photo_kos"></label>
                            <input type="file" class="form-control {{$errors->first('photo_kos') ? 'is-invalid' : ''}}"
                            name="photo_kos" id="photo_kos">
                            <span class="error invalid-feedback">{{$errors->first('photo_kos')}}</span>
                          </div>



                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control {{$errors->first('latitude') ? 'is-invalid' : ''}}" name="latitude" id="latitude" placeholder="Silahkan isi Latitude" value="{{$mitra->latitude}}">
                            <span class="error invalid-feedback">{{$errors->first('latitude')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control {{$errors->first('longitude') ? 'is-invalid' : ''}}" name="longitude" id="longitude" placeholder="Silahkan isi Longitude" value="{{$mitra->longitude}}">
                            <span class="error invalid-feedback">{{$errors->first('longitude')}}</span>
                        </div>

                        <button type="submit" class="btn btn-primary mx-auto">Update Mitra</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
