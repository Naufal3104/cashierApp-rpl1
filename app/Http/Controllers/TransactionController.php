<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::doesntHave('cart')->where('stock', '>', 0)->get()->sortBy('name');
        $cart = Item::has('cart')->get()->sortByDesc('cart.create_at');
        // return $items;
        return view('transaksi',compact('items','cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function checkout(Request $request)
    {
        $messages = [
            'required' =>':attribute harus diisi terlebih dahulu',
        ];
        $this->validate ($request,[
            'pay_total' => 'required',
        ],$messages);
            Transaction::create($request->all());
        foreach (Cart::all() as $item){
            TransactionDetail::create([ 
                'transaction_id' => Transaction::latest()->first()->id,
                'item_id' => $item->item_id,
                'qty' => $item->qty,
                'subtotal' => $item->item->price*$item->qty
            ]);
        }
        Cart::truncate();

        return redirect(route('transaksi.show',Transaction::latest()->first()->id));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::create($request->all());
        return redirect()->back()->with('status', 'Item ditambahkan ke tabel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
