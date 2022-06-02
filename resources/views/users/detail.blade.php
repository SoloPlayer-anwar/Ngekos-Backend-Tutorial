@extends('layouts.bootstrap')

@section('title')
Page Details
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Details {{$users->name}}</h3>
            </div>


            <div class="card-body table-responsive">
                <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
            </div>
            <hr>

            <table class="table table-bordered">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td>{{$users->name}}</td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{$users->email}}</td>
                </tr>

                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{$users->jenis_kelamin}}</td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$users->alamat}}</td>
                </tr>

                <tr>
                    <td>Kota</td>
                    <td>:</td>
                    <td>{{$users->kota}}</td>
                </tr>


                <tr>
                    <td>Phone Number</td>
                    <td>:</td>
                    <td>{{$users->phone}}</td>
                </tr>

                <tr>
                    <td>Avatar</td>
                    <td>:</td>
                    <td>
                        <img src="{{$users->avatar}}" alt="" width="50px" height="50px">
                    </td>
                </tr>

                <tr>
                    <td>Verifikasi</td>
                    <td>:</td>
                    <td>
                        {{$users->verifikasi}}
                    </td>
                </tr>

                <tr>
                    <td>Latitude</td>
                    <td>:</td>
                    <td>
                        {{$users->latitude}}
                    </td>
                </tr>

                <tr>
                    <td>Longtiude</td>
                    <td>:</td>
                    <td>
                        {{$users->longitude}}
                    </td>
                </tr>
            </table>

            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
