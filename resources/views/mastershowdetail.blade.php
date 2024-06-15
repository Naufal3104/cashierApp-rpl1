@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Waktu   :   {{$detail->created_at}}<br>
                    Kasir   :   {{$detail->user->name}}
                    <table class="table table-responsive text-center">
                        <thead>
                            <td>No</td>
                            <td>Item</td>
                            <td>QTY</td>
                            <td>Harga</td>
                            <td>Subtotal</td>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($detail->detail as $item)
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->item->name}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{number_format($item->item->price)}}</td>
                                <td>{{number_format($item->qty * $item->item->price)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end">GrandTotal</td>
                                <td colspan="5">{{number_format($detail->total)}}</td>
                            </tr>                          
                            <tr>
                                <td colspan="4" class="text-end">Payment</td>
                                <td colspan="5">{{number_format($detail->pay_total)}}</td>
                            </tr>                          
                            <tr>
                                <td colspan="4" class="text-end">Change</td>
                                <td colspan="5">{{number_format($detail->pay_total - $detail->total)}}</td>
                            </tr>                          
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="text-end"><a href="/transaction" class="btn btn-primary">Kembali</a></div>
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