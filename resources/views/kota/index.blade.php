@extends('layouts.bootstrap')

@section('title')
Home Page
@endsection


@section('content')
<div class="row mx-auto">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Kota</h3>
            </div>
            <div class="card body table-responsive">
                <br>
                @include('alert.success')
                <br>/

                @if (Request::get('keyword'))
                <a href="{{route('kota.index')}}" class="btn btn-success">Back</a>
                @else
                <a href="{{route('kota.create')}}" class="btn btn-success m-3" style="width: 200px;"><i class="fas fa-plus"></i>
                Create Kota</a>
                @endif
                <hr/>

                <form method="GET"  action="{{route('kota.index')}}">

                    <div class="row">
                        <div class="col-2">
                            <b class="m-3">Search Name</b>
                        </div>

                        <div class="col-3">
                            <input type="text" name="keyword" id="keyword" class="form-control" value="{{Request::get('keyword')}}">
                        </div>

                        <div class="col-4">
                            <button class="btn btn-default" type="submit">
                                <i class="fas fa-seacrh"></i>
                            </button>
                        </div>

                    </div>
                </form>
                <hr/>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th widht="7%">No</th>
                        <th widht="15%">Name</th>
                        <th widht="15%">Photo Kota</th>
                        <th widht="40%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($kota as $row )
                        <tr>
                            <td>{{$loop->iteration + ($kota->perPage() * ($kota->currentPage() -1))}}
                            </td>
                            <td>{{$row->nama_kota}}</td>
                            <td>
                                <img src="{{$row->photo_kota}}" alt="" width="40px" height="40px" class="rounded mx-auto d-block">
                            </td>

                            <td>
                                <a href="{{route('kota.edit', [$row->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{route('kota.destroy', [$row->id])}}" method="POST" onsubmit="return confirm('Delete This Item ?')" class="d-inline">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="card-footer">
                {{$kota->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
