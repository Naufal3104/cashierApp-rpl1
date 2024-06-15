@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body text-center">
                    <div class="content text-center">
                        <a href="/item" class="btn btn-primary btn-sm">Item</a>
                        <a href="/transaksi" class="btn btn-warning btn-sm">Transaksi</a>
                        <a href="/category" class="btn btn-success btn-sm">Category</a>
                    </div>                   
                </div>
                <div class="card-body text-center">
                    <a href="/transaction" class="btn btn-dark btn-lg w-25">Pembelian</a>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
