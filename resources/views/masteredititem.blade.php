@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Edit Item') }}</div>
                    <div class="card-body">
                        <form class="" action="{{route('item.update',$items->id)}}" enctype="multipart/form-data" method="POST">
                            {{method_field('PUT')}}
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Item</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{$items->name}}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select type="text" class="form-control form-select" name="category_id" id="category_id">  
                                    <label for="category_id">Kategori</label>
                                    @foreach ($kategori as $item) 
                                    @if ($items->category_id == $item->id)
                                    <option value ="{{$item->id}}" selected>{{$item->name}}</option>  
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option> 
                                    @endif
                                    @endforeach
                                </select>
                            </div>   
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input class="form-control" type="text" name="price" id="price" value="{{$items->price}}">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input class="form-control" type="number" min="1" name="stock" id="stock" value="{{$items->stock}}">
                            </div> 
                            <div class="form-group mt-4">
                                <input class="btn btn-success" type="submit" name="Simpan" value="Simpan">
                                <a class="btn btn-danger" href="/item">Batal</a>
                            </div>
                            @if (count($errors) > 0)
                                <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- <option selected ></option>
@foreach ($data1 as $item)
    
@if ($data->id_siswa == $item->id)
<option value ="{{$item->id}}" selected>{{$item->nama}}</option>  
@else
<option value="{{$item->id}}">{{$item->nama}}</option> 
@endif
@endforeach --}}