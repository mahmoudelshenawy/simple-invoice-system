<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invoice;
use Illuminate\Http\Request;
use DataTables;

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

    public function test(Request $request)
    {

        $categories = Category::all();

        if ($request->ajax()) {
            $invoices = Invoice::query();
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('client', function ($q) {
                    $client =  $q->client;
                    return view('test_btn', compact('client'));
                })
                ->editColumn('created_at', function ($q) {
                    return $q->created_at->format('m/d/Y') . '<br>' . $q->created_at->format('h:i:s A');
                })
                ->editColumn('status', 'test_status')
                ->addColumn('actions', 'test_actions')
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search_name')) {
                        $instance->searchByName($request->search_name);
                    }
                    if ($request->get('search_date')) {
                        $instance->searchByName($request->search_date);
                    }
                    // if (!empty($request->get('search'))) {
                    //     $instance->where(function ($w) use ($request) {
                    //         $search = $request->get('search');
                    //         // $w->orWhere('name', 'LIKE', "%$search%")
                    //         //     ->orWhere('email', 'LIKE', "%$search%");
                    //     });
                    // }
                })
                ->rawColumns(['client', 'created_at', 'status', 'actions'])
                ->make(true);
        }
        return view('test');
    }
}
