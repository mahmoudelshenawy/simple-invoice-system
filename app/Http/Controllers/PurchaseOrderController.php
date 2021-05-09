<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\Supplier;
use App\Product;
use App\Service;
use App\User;
use App\ExpenseInvestment;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = PurchaseOrder::all();
        $suppliers = Supplier::all(['name', 'legal_name', 'id']);
        return view('purchase.purchase_orders.index', compact('purchases', 'suppliers'));
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

        $purchase = PurchaseOrder::create([
            'supplier_id' => $request->supplier_id
        ]);

        return redirect('choose_items_of_purchase_order/' . $purchase->id);
    }

    public function chooseItemsOfPurchase($id)
    {
        $purchase = PurchaseOrder::findOrFail($id);
        $products = Product::all();
        $services = Service::all();
        $expInvs = ExpenseInvestment::all();
        session()->flash('choose_item');
        return view('purchase.purchase_orders.choose_items', compact('purchase', 'products', 'services', 'expInvs'));
    }

    public function addItemsToPurchase(Request $request, $id)
    {
        $purchase = PurchaseOrder::findOrFail($id);
        $proIds = $request->product_id;
        $servIds = $request->service_id;
        $expIds = $request->expense_id;

        $proQtys = $request->quantity;
        $servQtys = $request->quantity_service;
        $expQtys = $request->quantity_expense;

        $purchase->products()->detach();
        $purchase->services()->detach();
        $purchase->expensesInvestments()->detach();
        if (!empty($proIds)) {
            foreach ($proIds as $index => $proId) {
                $purchase->products()->attach($proId, ['quantity' => $proQtys[$index]]);
            }
        }
        if (!empty($servIds)) {
            foreach ($servIds as $index => $servId) {
                $purchase->services()->attach($servId, ['quantity' => $servQtys[$index]]);
            }
        }
        if (!empty($expIds)) {
            foreach ($expIds as $index => $expId) {
                $purchase->expensesInvestments()->attach($expId, ['quantity' => $expQtys[$index]]);
            }
        }
        session()->flash('complete_data');
        return redirect('purchase_order_data/' . $purchase->id);
    }

    public function completePurchaseOrderData($id)
    {
        $purchase = PurchaseOrder::findOrFail($id);
        $admins = User::role('Administrator')->get();

        session()->flash('complete_data');
        return view('purchase.purchase_orders.complete_purchase_data', compact('purchase', 'admins'));
    }

    public function storePurchaseOrderData(Request $request, $id)
    {
        $purchase = PurchaseOrder::findOrFail($id);
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:purchase_orders,reference_number,' . $id,
        ]);

        $attrs = $request->only(['title', 'date', 'delivery_date', 'email_sent_date', 'currency', 'payment_option', 'bank_account', 'status', 'agent', 'comments', 'private_comments', 'subtotal', 'total', 'created_by']);

        $attrs['reference_number'] = 'PO' . $request->reference_number;

        $purchase->update($attrs);
        session()->flash('Update', 'تم تحديث البيانات بنجاح');
        return redirect('/purchase_orders');
    }

    public function getPurchaseDeliveryNotes()
    {
        $status = ['In Progress', 'Closed', 'Pending', 'Invoiced'];
        $purchases = PurchaseOrder::whereIn('status', $status)->get();
        $suppliers = Supplier::all(['name', 'legal_name', 'id']);
        return view('purchase.purchase_orders.purchase_delivery_notes', compact('purchases', 'suppliers'));
    }
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }
    public function destroy(Request $req)
    {
        $purchase = PurchaseOrder::findOrFail($req->id);
        $purchase->products()->detach();
        $purchase->services()->detach();
        $purchase->expensesInvestments()->detach();
        $purchase->delete();
        session()->flash('Delete');
        return redirect('/purchase_orders');
    }
}
