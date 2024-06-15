@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsive text-center">
                        <thead>
                            <th>No</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total</th>
                            <th>Pay Total</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $i = 1?>
                                @foreach ($data as $item)
                                <td>{{$i++}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->total}}</td>
                                <td>{{$item->pay_total}}</td>
                                <form action="">
                                <td>
                                    <a href="transaksi/{{$item->id}}" class="btn btn-success btn-sm">Detail</a>
                                </td>
                            </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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