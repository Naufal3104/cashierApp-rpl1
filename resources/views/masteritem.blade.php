@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Item') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsive text-center">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nama Item</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1?>  
                            @foreach ($data as $item)
                            <tr>
                                <th scope = "row">{{ $i++}}</th>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{$item->stock}}</td>
                                <td>
                                    <a href="/item/{{$item->id}}/edit" class="btn btn-warning btn-sm d-inline">Edit</a>
                                    <form action="item/{{$item->id}}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>                     
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Add Item') }}</div>
                    <div class="card-body">
                        <form class="" action="{{route('item.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Item</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select type="text" class="form-control form-select" name="category_id" id="category_id">  
                                    <option selected></option>
                                    @foreach ($data1 as $item)                                
                                    <option value ={{$item->id}}>{{$item->name}}</option> 
                                    @endforeach
                                </select>
                            </div>   
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input class="form-control" type="text" name="price" id="price" value ="{{old('price')}}">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input class="form-control" type="number" min="1" name="stock" id="stock" value ="{{old('stock')}}">
                            </div> 
                            <div class="form-group mt-4">
                                <input class="btn btn-success" type="submit" name="Simpan" value="Simpan">
                                <a class="btn btn-danger" href="/">Batal</a>
                            </div>
                        </form>
                    </div>
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
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