<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use File;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Item::all();
        $data1 = Category::all();
        return view('masteritem',compact('data','data1'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka'
        ];

        $this->validate($request,[
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ],$messages);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return redirect('item');
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
        $items = Item::find($id);
        $kategori = Category::all();
        return view('masteredititem', compact('kategori','items'));
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
        $messages = [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka'
        ];

        $this->validate($request,[
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ],$messages);

        $item = Item::find($id);
            $item->name = $request->name;
            $item->category_id = $request->category_id;
            $item->price = $request->price;
            $item->stock = $request->stock;
            $item->save();

        return redirect('item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id)->delete();
        return redirect()->back();
    }
}
