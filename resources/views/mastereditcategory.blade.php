@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Edit Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="{{route('category.update',$data->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{$data->name}}">
                            </div>

                            <div class="form-group mt-2">
                                <input class="btn btn-success" type="submit" name="Simpan" value="Simpan">
                                <a class="btn btn-danger" href="/category">Batal</a>
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
