<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('settings.categories.index', compact('categories'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:categories',
            'parent_id' => 'nullable|numeric',
            'type' => 'required|string'
        ]);


        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'type' => $request->type,
        ]);

        session()->flash('add_section', 'تم اضافة القسم بنجاح');
        return back();
    }

    public function update(Request $request)
    {
        $cat = Category::findOrFail($request->id);
        $this->validate($request, [
            'name' => 'required|string|unique:categories,name,' . $cat->name,
            'parent_id' => 'nullable|numeric',
            'type' => 'required|string'
        ]);
        $cat->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'type' => $request->type,
        ]);

        session()->flash('update_section', 'تم تعديل القسم بنجاح');
        return back();
    }


    public function destroy(Request $request)
    {
        $cat = Category::findOrFail($request->id);
        $cat->delete();
        session()->flash('delete_section');
        return back();
    }
}
