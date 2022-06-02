@extends('layouts.bootstrap')

@section('title')
Page Details Mitra
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Details {{$mitra->name_mitra}}</h3>
            </div>


            <div class="card-body table-responsive">
                <a href="{{route('mitra.index')}}" class="btn btn-secondary">Back</a>
            </div>
            <hr>

            <table class="table table-bordered">
                <tr>
                    <td>Name Mitra</td>
                    <td>:</td>
                    <td>{{$mitra->name_mitra}}</td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$mitra->alamat_mitra}}</td>
                </tr>

                <tr>
                    <td>Phone Mitra</td>
                    <td>:</td>
                    <td>{{$mitra->phone_mitra}}</td>
                </tr>


                <tr>
                    <td>Photo Ktp</td>
                    <td>:</td>
                    <td>
                        <img src="{{$mitra->photo_ktp}}" alt="" width="50px" height="50px">
                    </td>
                </tr>

                <tr>
                    <td>Photo Kos</td>
                    <td>:</td>
                    <td>
                        <img src="{{$mitra->photo_kos}}" alt="" width="50px" height="50px">
                    </td>
                </tr>

                <tr>
                    <td>Latitude</td>
                    <td>:</td>
                    <td>
                        {{$mitra->latitude}}
                    </td>
                </tr>

                <tr>
                    <td>Longtiude</td>
                    <td>:</td>
                    <td>
                        {{$mitra->longitude}}
                    </td>
                </tr>
            </table>

            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
