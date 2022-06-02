@extends('layouts.bootstrap')

@section('title')
Create Data Product
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Product</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">


                  <div class="form-group">
                    <label for="name_kos">Name Kos</label>
                    <input type="text" class="form-control {{$errors->first('name_kos') ? 'is-invalid' : ''}}" name="name_kos" id="name_kos" placeholder="Enter Name Kos" value="{{ old('name_kos') }}">
                    <span class="error invalid-feedback">{{$errors->first('name_kos')}}</span>
                  </div>


                  <div class="form-group">
                    <label for="rating_kos">Rating Kos</label>
                    <input type="text" class="form-control {{$errors->first('rating_kos') ? 'is-invalid' : ''}}" name="rating_kos" id="rating_kos" placeholder="Enter Rating Kos" value="{{ old('rating_kos') }}">
                    <span class="error invalid-feedback">{{$errors->first('rating_kos')}}</span>
                  </div>


                  <div class="form-group">
                    <label for="tags_kos">Tags Kos</label>
                    <input type="text" class="form-control {{$errors->first('tags_kos') ? 'is-invalid' : ''}}" name="tags_kos" id="tags_kos" placeholder="Enter Tags Kos" value="{{ old('tags_kos') }}">
                    <span class="error invalid-feedback">{{$errors->first('tags_kos')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="description_kos">Description Kos</label>
                    <textarea type="text" class="form-control {{$errors->first('description_kos') ? 'is-invalid' : ''}}" name="description_kos" id="description_kos" placeholder="Enter Description Kos" value="{{ old('description_kos') }}"></textarea>
                    <span class="error invalid-feedback">{{$errors->first('description_kos')}}</span>
                  </div>


                  <div class="form-group">
                    <label for="price_kos">Price Product</label>
                    <input type="numeric" class="form-control {{$errors->first('price_kos') ? 'is-invalid' : ''}}" name="price_kos" id="price_kos" placeholder="Enter Price Kos" value="{{ old('price_kos') }}">
                    <span class="error invalid-feedback">{{$errors->first('price_kos')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="photo_product">Photo Product</label>
                    <input type="file" class="form-control {{$errors->first('photo_product') ? 'is-invalid' : ''}}"
                    name="photo_product" id="photo_product">
                    <span class="error invalid-feedback">{{$errors->first('photo_product')}}</span>
                  </div>

                  <div class="form-group">
                      <label for="user_id">User</label>
                      <select name="user_id" id="user_id" class="form-control">
                          @foreach ($users as $user )
                              <option value="{{$user->id}}">{{$user->role}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="fasilitas_id">Fasilitas Kategori</label>
                    <select name="fasilitas_id" id="fasilitas_id" class="form-control">
                        @foreach ($fasilitas as $facility )
                            <option value="{{$facility->id}}">{{$facility->name_fasilitas}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kota_id">Kota Kategori</label>
                    <select name="kota_id" id="kota_id" class="form-control">
                        @foreach ($kotas as $city )
                            <option value="{{$city->id}}">{{$city->nama_kota}}</option>
                        @endforeach
                    </select>
                </div>


                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom_script')
<link rel="stylesheet" href="{{asset('adminlte/plugins/summernote/summernote-bs4.min.css')}}">
<script src="{{asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#description_kos").summernote({
            toolbar: [
    // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
    ]
        });
    });
</script>
@endsection
