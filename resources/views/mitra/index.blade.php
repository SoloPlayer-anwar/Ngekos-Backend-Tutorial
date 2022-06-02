@extends('layouts.bootstrap')

@section('title')
Mitra Page
@endsection


@section('content')
<div class="row mx-auto">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Mitra</h3>
            </div>
            <div class="card body table-responsive">
                @include('alert.success')
                <br>/

                @if (Request::get('keyword'))
                <a href="{{route('mitra.index')}}" class="btn btn-success">Back</a>
                @else

                @endif
                <hr/>

                <form method="GET"  action="{{route('mitra.index')}}">

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
                        <th widht="15%">Name Mitra</th>
                        <th widht="15%">Alamat Mitra</th>
                        <th widht="15%">Photo Ktp</th>
                        <th widht="40%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($mitra as $row )
                        <tr>
                            <td>{{$loop->iteration + ($mitra->perPage() * ($mitra->currentPage() -1))}}
                            </td>
                            <td>{{$row->name_mitra}}</td>
                            <td>{{$row->alamat_mitra}}</td>
                            <td>
                                <img src="{{$row->photo_ktp}}" alt="" width="40px" height="40px" class="rounded mx-auto d-block">
                            </td>

                            <td>
                                <a href="{{route('mitra.edit', [$row->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{route('mitra.show', [$row->id])}}" class="btn btn-primary btn-sm">Details</a>
                                <form action="{{route('mitra.destroy', [$row->id])}}" method="POST" onsubmit="return confirm('Delete This Item ?')" class="d-inline">
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
                {{$mitra->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
