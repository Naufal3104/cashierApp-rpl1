@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsve">
                        <thead>
                            <th>No</th>
                            <th>Nama kategori</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1?>
                            @foreach ($data as $item) 
                            <tr>
                                <th>{{$i++}}</th>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a href="category/{{$item->id}}/edit" class="btn btn-warning btn-sm d-inline">Edit</a>
                                    <form action="category/{{$item->id}}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm ">Hapus</button>
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
                <div class="card-header">{{ __('Add Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{old('name')}}">
                            </div>

                            <div class="form-group mt-2">
                                <input class="btn btn-success" type="submit" name="Simpan" value="Simpan">
                                <form action=""></form>
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
