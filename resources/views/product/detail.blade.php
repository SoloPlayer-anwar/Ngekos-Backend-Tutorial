@extends('layouts.bootstrap')

@section('title')
Page Details Product
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Details {{$product->name_kos}}</h3>
            </div>


            <div class="card-body table-responsive">
                <a href="{{route('product.index')}}" class="btn btn-secondary">Back</a>
            </div>
            <hr>

            <table class="table table-bordered">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td>
                        @foreach ($users as $user )
                            @if ($user->id == $product->user_id)
                                {{$user->role}}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td>Fasilitas Kategori</td>
                    <td>:</td>
                    <td>
                        @foreach ($fasilitas as $facility )
                            @if ($facility->id == $product->fasilitas_id)
                                {{$facility->name_fasilitas}}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td>Kota Kategori</td>
                    <td>:</td>
                    <td>
                        @foreach ($kotas as $city )
                        @if ($city->id == $product->kota_id)
                            {{$city->nama_kota}}
                        @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td>Name Kos</td>
                    <td>:</td>
                    <td>{{$product->name_kos}}</td>
                </tr>

                <tr>
                    <td>Rating Kos</td>
                    <td>:</td>
                    <td>{{$product->rating_kos}}</td>
                </tr>


                <tr>
                    <td>Tags Kos</td>
                    <td>:</td>
                    <td>{{$product->tags_kos}}</td>
                </tr>

                <tr>
                    <td>Description Kos</td>
                    <td>:</td>
                    <td>
                       {{$product->description_kos}}
                    </td>
                </tr>

                <tr>
                    <td>Price Kos</td>
                    <td>:</td>
                    <td>
                        {{$product->price_kos}}
                    </td>
                </tr>

                <tr>
                    <td>Photo Product</td>
                    <td>:</td>
                    <td>
                        <img src="{{$product->photo_product}}" alt="" width="50px" height="50px">
                    </td>
                </tr>

            </table>

            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
