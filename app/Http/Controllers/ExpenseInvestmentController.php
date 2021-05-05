<?php

namespace App\Http\Controllers;

use App\ExpenseInvestment;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;

class ExpenseInvestmentController extends Controller
{

    public function index()
    {
        $expinvs = ExpenseInvestment::all();
        return view('catalog.expenses&investment.index', compact('expinvs'));
    }
    public function create()
    {
        return view('catalog.expenses&investment.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:expense_investments,reference_number',
            'name' => 'required',
            'type' => 'required|in:expense,investment',
            'category_id' => 'nullable|numeric'
        ]);

        $attrs = $request->only(['name', 'sales_price', 'description', 'tax', 'category_id']);
        $attrs['reference_number'] = 'EAI' . $request->reference_number;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $attrs['image'] = $file_name;
            // save the image
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path("Attachments/Expenses&Investment/" . $attrs['reference_number']), $imageName);
        }

        $expenseInvestment = ExpenseInvestment::create($attrs);
        session()->flash('Add', 'تم اضافة البيانات بنجاح');
        return back();
    }

    public function getTypeOfEAI($type)
    {
        $categories = Category::where('type', $type)->get();
        return $categories;
    }

    public function show($id)
    {
        $exp = ExpenseInvestment::findOrFail($id);
        $purchase_orders = $exp->purchaseOrders;
        $purchase_invoices = $exp->purchaseInvoices;

        return view('catalog.expenses&investment.exp-details', compact('exp', 'purchase_orders', 'purchase_invoices'));
    }
    public function edit($id)
    {
        $exp = ExpenseInvestment::findOrFail($id);
        return view('catalog.expenses&investment.edit', compact('exp'));
    }

    public function update(Request $request, $id)
    {
        $exp = ExpenseInvestment::findOrFail($id);
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:expense_investments,reference_number,' . $exp->reference_number,
            'name' => 'required',
            'type' => 'required|in:expense,investment',
            'category_id' => 'nullable|numeric'
        ]);

        $attrs = $request->only(['name', 'sales_price', 'description', 'tax', 'category_id']);
        $attrs['reference_number'] = 'EAI' . $request->reference_number;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $attrs['image'] = $file_name;
            // delete the existing one
            if ($exp->image !== null) {
                Storage::disk('public_uploads')->delete("Expenses&Investment/" . $attrs['reference_number'] . '/' . $exp->image);
            }
            // save the image
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path("Attachments/Expenses&Investment/" . $attrs['reference_number']), $imageName);
        }

        $exp->update($attrs);
        session()->flash('Update', 'تم تعديل البيانات بنجاح');
        return redirect('catalog/expenses_investment');
    }
    public function destroy(Request $request)
    {
        $exp = ExpenseInvestment::findOrFail($request->id);
        if ($exp->image !== null || count($exp->attachment) > 0) {
            $path = "/Expenses&Investment/" . $exp->reference_number;
            Storage::disk('public_uploads')->deleteDirectory($path);
            $exp->deleteAttachs();
        }
        $exp->delete();
        session()->flash('Delete', 'تم حدف النفقة بنجاح');
        return back();
    }
}
