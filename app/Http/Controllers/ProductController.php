<?php

namespace App\Http\Controllers;

use App\Product;
use App\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('section')->get();
        $sections = Section::all();
        return view('products.products', compact('products', 'sections'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:products',
            'section_id' => 'required|numeric'
        ]);

        $name = auth()->user()->name;
        Product::create([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'description' => $request->description
        ]);

        session()->flash('add_product', 'تم اضافة المنتج بنجاح');
        return back();
    }

    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'name' => 'required|string|unique:products',
            'section_id' => 'required|numeric'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'description' => $request->description
        ]);

        session()->flash('update_product', 'تم تعديل المنتج بنجاح');
        return back();
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->delete();
        session()->flash('delete_product', 'تم حدف المنتج بنجاح');
        return back();
    }
}
