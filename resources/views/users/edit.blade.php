@extends('layouts.bootstrap')

@section('title')
Edit Users
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Edit {{$users->name}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('users.update', [$users->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">UserName</label>
                            <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name" placeholder="Silahkan isi Username" value="{{$users->name}}">
                            <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" disabled name="email" id="email" placeholder="Silahkan isi Email " value="{{$users->email}}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" disabled name="password" id="password" placeholder="Password Cek" value="{{$users->password}}">
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" id="jenis_kelamin" class="form-control {{$errors->first('jenis_kelamin') ? 'is-invalid' : ''}}">
                            <option value="Laki-Laki" @if ($users->jenis_kelamin == 'Laki-Laki') selected
                            @endif>Laki-Laki</option>
                            <option value="Perempuan" @if ($users->jenis_kelamin == 'Perempuan') selected
                                @endif>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control {{$errors->first('alamat') ? 'is-invalid' : ''}}" name="alamat" id="alamat" placeholder="Silahkan isi Username" value="{{$users->alamat}}">
                            <span class="error invalid-feedback">{{$errors->first('alamat')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control {{$errors->first('kota') ? 'is-invalid' : ''}}" name="kota" id="kota" placeholder="Silahkan isi Username" value="{{$users->kota}}">
                            <span class="error invalid-feedback">{{$errors->first('kota')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}" name="phone" id="phone" placeholder="Silahkan isi Username" value="{{$users->phone}}">
                            <span class="error invalid-feedback">{{$errors->first('phone')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" id="role" class="form-control {{$errors->first('jenis_kelamin') ? 'is-invalid' : ''}}">
                            <option value="admin" @if ($users->role == 'admin') selected
                            @endif>Admin</option>
                            <option value="user" @if ($users->role == 'user') selected
                                @endif>User</option>
                            <option value="pemilik_kos" @if ($users->role == 'pemilik_kos') selected
                                 @endif>Pemilik Kos</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <div class="input-group">
                                <img src="{{$users->avatar}}" width="40px" height="40px" alt="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="avatar"></label>
                            <input type="file" class="form-control {{$errors->first('avatar') ? 'is-invalid' : ''}}"
                            name="avatar" id="avatar">
                            <span class="error invalid-feedback">{{$errors->first('avatar')}}</span>
                          </div>

                          <div class="form-group">
                            <label for="verifkasi">Verfikasi</label>
                            <select name="verifkasi" id="verifkasi" id="verifkasi" class="form-control {{$errors->first('verifkasi') ? 'is-invalid' : ''}}">
                            <option value="belum" @if ($users->verifikasi == 'belum') selected
                            @endif>Belum</option>
                            <option value="sudah" @if ($users->verifikasi == 'sudah') selected
                                @endif>Sudah</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control {{$errors->first('latitude') ? 'is-invalid' : ''}}" name="latitude" id="latitude" placeholder="Silahkan isi Latitude" value="{{$users->latitude}}">
                            <span class="error invalid-feedback">{{$errors->first('latitude')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control {{$errors->first('longitude') ? 'is-invalid' : ''}}" name="longitude" id="longitude" placeholder="Silahkan isi Longitude" value="{{$users->longitude}}">
                            <span class="error invalid-feedback">{{$errors->first('longitude')}}</span>
                        </div>

                        <button type="submit" class="btn btn-primary mx-auto">Update User</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
