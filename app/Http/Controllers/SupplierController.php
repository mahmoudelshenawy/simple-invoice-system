<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuppliersRequest;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::all();
        return view('purchase.suppliers.index', compact('suppliers'));
    }
    public function create()
    {
        $admins = User::role('Administrator')->get();
        return view('purchase.suppliers.create', compact('admins'));
    }

    public function store(SuppliersRequest $request)
    {
        $attrs = $request->only(['legal_name', 'name', 'tin', 'phone_1', 'phone_2', 'email', 'fax', 'address', 'comments', 'discount', 'payment_option', 'payment_terms', 'payment_adjustment', 'agent', 'currency', 'bank_account', 'bank_name', 'BIC/SWIFT']);

        $attrs['reference_number'] = 'SUP' . $request->reference_number;
        $supplier = Supplier::create($attrs);

        session()->flash('Add');
        return back();
    }
    public function show(Supplier $supplier)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        $admins = User::role('Administrator')->get();
        return view('purchase.suppliers.edit', compact('supplier', 'admins'));
    }

    public function update(SuppliersRequest $request, Supplier $supplier)
    {
        $attrs = $request->only(['legal_name', 'name', 'tin', 'phone_1', 'phone_2', 'email', 'fax', 'address', 'comments', 'discount', 'payment_option', 'payment_terms', 'payment_adjustment', 'agent', 'currency', 'bank_account', 'bank_name', 'BIC/SWIFT']);

        $attrs['reference_number'] = 'SUP' . $request->reference_number;
        $supplier->update($attrs);
        session()->flash('Update');
        return redirect('/suppliers');
    }


    public function destroy(Request $req)
    {
        $supplier = Supplier::findOrFail($req->id);
        $supplier->delete();
        session()->flash('Delete');
        return back();
    }

    public function getSuppliersList()
    {
        $suppliers = Supplier::with('purchase_invoices', 'purchase_orders')->orderBy('legal_name', 'asc')->get();

        $groups = $suppliers->reduce(function ($carry, $supplier) {

            // get first letter
            $first_letter = $supplier['legal_name'][0];

            if (!isset($carry[$first_letter])) {
                $carry[$first_letter] = [];
            }

            $carry[$first_letter][] = $supplier;

            return $carry;
        }, []);
        $suppliers = Supplier::all();
        return view('purchase.suppliers.suppliers_list', compact('groups'));
    }
}
