@extends('layouts.bootstrap')

@section('title')
Home Page
@endsection


@section('content')
<div class="row mx-auto">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Users</h3>
            </div>
            <div class="card body table-responsive">
                @include('alert.success')
                <br>/

                @if (Request::get('keyword'))
                <a href="{{route('users.index')}}" class="btn btn-success">Back</a>
                @else

                @endif
                <hr/>

                <form method="GET"  action="{{route('users.index')}}">

                    <div class="row">
                        <div class="col-2">
                            <b class="m-3">Search Name</b>
                        </div>

                        <div class="col-3">
                            <input type="text" name="keyword" id="keyword" class="form-control" value="{{Request::get('keyword')}}">
                        </div>


                        <div class="col-3">
                            <select name="role" id="role" class="form-control">

                                <option value="admin" @if (Request::get('role') == 'admin') selected
                                @endif>Admin</option>

                                <option value="user" @if (Request::get('role') == 'user') selected
                                @endif>User</option>

                                <option value="pemilik_kos" @if (Request::get('role') == 'pemilik_kos') selected
                                @endif>Pemilik Kos</option>

                            </select>
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
                        <th widht="15%">Email</th>
                        <th widht="15%">Avatar</th>
                        <th widht="15%">Role</th>
                        <th widht="15%">Status</th>
                        <th widht="40%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row )
                        <tr>
                            <td>{{$loop->iteration + ($users->perPage() * ($users->currentPage() -1))}}
                            </td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>
                                <img src="{{$row->avatar}}" alt="" width="40px" height="40px" class="rounded mx-auto d-block">
                            </td>
                            <td>{{$row->role}}</td>
                            <td>{{$row->verifikasi}}</td>

                            <td>
                                <a href="{{route('users.edit', [$row->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{route('users.show', [$row->id])}}" class="btn btn-primary btn-sm">Details</a>
                                <form action="{{route('users.destroy', [$row->id])}}" method="POST" onsubmit="return confirm('Delete This Item ?')" class="d-inline">
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
                {{$users->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
