@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Item') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-dismissable alert-success" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-responsive text-center">
                        <thead>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Item</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if ($items->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No Items</td>
                            </tr>
                            @else
                            <tr>
                                @foreach($items as $item)
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{$item->stock}}</td>
                                <form action="{{route('transaction.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <td>
                                    <input type="hidden" name="item_id" value="{{$item->id}}" id="item_id">
                                    <input type="hidden" name="qty" value="1" id="qty">
                                    <button type ="submit" class = "btn btn-success btn-sm">Add to cart</button>
                                </td>
                            </form>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}</div>
                <div class="card-body">
                    <table class="table table-responsive text-center">
                        <thead>
                            <td>No</td>
                            <td>Nama</td>
                            <td>QTY</td>
                            <td>Subtotal</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @if ($cart->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">No Carts</td>
                            </tr>
                            @else
                        <tr>
                            @foreach($cart as $item)
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <form action="{{route('transaksi.update', $item->cart->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <td><input type="number" class="form-control" name="qty" min="1" max="{{$item->stock + $item->cart->qty}}" value="{{$item->cart->qty}}" onchange="ubah{{$loop->iteration}}()"></td>
                            <script>
                                function ubah{{$loop->iteration}}(){
                                    document.getElementById("update{{$loop->iteration}}").style.display = "inline";
                                    document.getElementById("hapus{{$loop->iteration}}").style.display = "none";
                                }
                            </script>
                            <td>{{number_format($item->price * $item->cart->qty)}}</td>
                            <td>
                                    <button id="update{{$loop->iteration}}" class="btn btn-warning btn-sm" style="display: none">Update</button>
                                </form>
                                <form action="transaksi/{{$item->cart->id}}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button id="hapus{{$loop->iteration}}" class="btn btn-danger btn-sm" style="display: ">Hapus</button>
                                </form>
                            </td>
                        </tr>
                            <tr>
                                @endforeach
                                @endif
                            <form action="{{route('transaction.checkout')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            </tr>
                            <tr>
                                <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="date" id="" value="{{now()}}">
                                <td colspan="3">Subtotal</td>
                                <td colspan="2">
                                    <input type="number" class="form-control"  name="total" id=""
                                    value="{{$cart->sum(function($item){return $item->price * $item->cart->qty;})}}"> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Payment</td>
                                <td colspan="2">
                                    <input class="form-control" name="pay_total" id="pay_total" min="{{$cart->sum(function($item){return $item->price * $item->cart->qty;})}}" type="number"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><button id="simpan" class="btn btn-primary" type="submit">Submit</button></td>
                                <td colspan="3"><button class="btn btn-danger" type="reset" >Reset</button></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
                @if (\Session::has('error'))
                <ul class="text-start text-danger">
                  <li>{!! \Session::get('error') !!}</li>
                </ul>
              </div>
              @endif
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