<?php

namespace App\Http\Controllers;

use App\PurchaseInvoice;
use App\Supplier;
use App\Product;
use App\Service;
use App\User;
use App\ExpenseInvestment;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    public function index()
    {
        $purchases = PurchaseInvoice::all();
        $suppliers = Supplier::all(['name', 'legal_name', 'id']);
        return view('purchase.purchase_invoices.index', compact('purchases', 'suppliers'));
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required|numeric'
        ]);

        $purchase = PurchaseInvoice::create([
            'supplier_id' => $request->supplier_id
        ]);

        return redirect('choose_items_of_purchase_invoice/' . $purchase->id);
    }

    public function chooseItemsOfPurchase($id)
    {
        $purchase = PurchaseInvoice::findOrFail($id);
        $products = Product::all();
        $services = Service::all();
        $expInvs = ExpenseInvestment::all();
        session()->flash('choose_item');
        return view('purchase.purchase_invoices.choose_items', compact('purchase', 'products', 'services', 'expInvs'));
    }

    public function addItemsToPurchase(Request $request, $id)
    {
        $purchase = PurchaseInvoice::findOrFail($id);
        $proIds = $request->product_id;
        $servIds = $request->service_id;
        $expIds = $request->expense_id;

        $proQtys = $request->quantity;
        $servQtys = $request->quantity_service;
        $expQtys = $request->quantity_expense;

        $purchase->products()->detach();
        $purchase->services()->detach();
        $purchase->expensesInvestments()->detach();
        foreach ($proIds as $index => $proId) {
            $purchase->products()->attach($proId, ['quantity' => $proQtys[$index]]);
        }
        foreach ($servIds as $index => $servId) {
            $purchase->services()->attach($servId, ['quantity' => $servQtys[$index]]);
        }
        foreach ($expIds as $index => $expId) {
            $purchase->expensesInvestments()->attach($expId, ['quantity' => $expQtys[$index]]);
        }
        session()->flash('complete_data');
        return redirect('purchase_invoice_data/' . $purchase->id);
    }

    public function completePurchaseInvoiceData($id)
    {
        $purchase = PurchaseInvoice::findOrFail($id);
        $admins = User::role('owner')->get();

        session()->flash('complete_data');
        return view('purchase.purchase_invoices.complete_purchase_data', compact('purchase', 'admins'));
    }

    public function storePurchaseInvoiceData(Request $request, $id)
    {
        $purchase = PurchaseInvoice::findOrFail($id);
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:purchase_invoices,reference_number,' . $id,
        ]);

        $attrs = $request->only(['title', 'date', 'delivery_date', 'email_sent_date', 'currency', 'payment_option', 'bank_account', 'status', 'agent', 'comments', 'private_comments', 'subtotal', 'total', 'discount', 'created_by']);

        $attrs['reference_number'] = 'PINV' . $request->reference_number;

        $purchase->update($attrs);
        session()->flash('Update', 'تم تحديث البيانات بنجاح');
        return redirect('/purchase_invoices');
    }

    public function getPurchaseDeliveryNotes()
    {
        $status = ['In Progress', 'Closed', 'Pending', 'Invoiced'];
        $purchases = PurchaseInvoice::whereIn('status', $status)->get();
        $suppliers = Supplier::all(['name', 'legal_name', 'id']);
        return view('purchase.purchase_invoices.purchase_delivery_notes', compact('purchases', 'suppliers'));
    }
    public function show(PurchaseInvoice $PurchaseInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseInvoice  $PurchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseInvoice $PurchaseInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseInvoice  $PurchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseInvoice $PurchaseInvoice)
    {
        //
    }
    public function destroy(Request $req)
    {
        $purchase = PurchaseInvoice::findOrFail($req->id);
        $purchase->products()->detach();
        $purchase->services()->detach();
        $purchase->expensesInvestments()->detach();
        $purchase->delete();
        session()->flash('Delete');
        return redirect('/purchase_invoices');
    }
}
