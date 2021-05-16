<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function index()
    {
        $stores = Store::all();
        return view('settings.stores.index', compact('stores'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required'
        ]);
        $attrs = $request->only(['name', 'address', 'phone_1', 'phone_2']);
        Store::create($attrs);
        session()->flash('Add');
        return back();
    }

    public function show(Store $store)
    {
        //
    }

    public function edit(Store $store)
    {
        //
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'address' => 'required'
        ]);
        $id = $request->id;
        $store = Store::findOrFail($id);
        $attrs = $request->only(['name', 'address', 'phone_1', 'phone_2']);
        $store->update($attrs);
        session()->flash('Update');
        return back();
    }

    public function destroy(Request $request)
    {
        $store = Store::findOrFail($request->id);
        $store->delete();
        session()->flash('Delete');
        return back();
    }
}
