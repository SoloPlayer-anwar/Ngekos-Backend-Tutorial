@extends('layouts.bootstrap')

@section('title')
Page Product
@endsection


@section('content')
<div class="row mx-auto">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Product</h3>
            </div>
            <div class="card body table-responsive">
                <br>
                @include('alert.success')
                <br>/

                @if (Request::get('keyword'))
                <a href="{{route('product.index')}}" class="btn btn-success">Back</a>
                @else
                <a href="{{route('product.create')}}" class="btn btn-success m-3" style="width: 200px;"><i class="fas fa-plus"></i>
                Create Product</a>
                @endif
                <hr/>

                <form method="GET"  action="{{route('product.index')}}">

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
                        <th widht="15%">Name Kos</th>
                        <th widht="15%">Photo Product</th>
                        <th widht="15%">Rating Kos</th>
                        <th widht="15%">Price Kos</th>
                        <th widht="40%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $row )
                        <tr>
                            <td>{{$loop->iteration + ($product->perPage() * ($product->currentPage() -1))}}
                            </td>
                            <td>{{$row->name_kos}}</td>
                            <td>
                                <img src="{{$row->photo_product}}" alt="" width="40px" height="40px" class="rounded mx-auto d-block">
                            </td>

                            <td>{{number_format($row->rating_kos)}}</td>

                            <td>{{number_format($row->price_kos)}}</td>

                            <td>
                                <a href="{{route('product.edit', [$row->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{route('product.show', [$row->id])}}" class="btn btn-primary btn-sm">Details</a>
                                <form action="{{route('product.destroy', [$row->id])}}" method="POST" onsubmit="return confirm('Delete This Item ?')" class="d-inline">
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
                {{$product->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
