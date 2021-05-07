<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Client;
use App\Product;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::all();
        $clients = Client::all(['name', 'legal_name', 'id']);
        return view('sales.index', compact('sales', 'clients'));
    }


    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        $services = Service::all();
        return view('sales.create', compact('clients', 'products', 'services'));
    }
    public function chooseItemsOfSale($id)
    {
        $sale = Sale::findOrFail($id);
        $products = Product::all();
        $services = Service::all();
        session()->flash('choose_item');
        return view('sales.choose_items', compact('sale', 'products', 'services'));
    }

    public function addItemsToSale(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $proIds = $request->product_id;
        $servIds = $request->service_id;

        $proQtys = $request->quantity;
        $servQtys = $request->quantity_service;

        $sale->products()->detach();
        $sale->services()->detach();

        if (!empty($proIds)) {
            foreach ($proIds as $index => $proId) {
                $sale->products()->attach($proId, ['quantity' => $proQtys[$index]]);
            }
        }
        if (!empty($servIds)) {
            foreach ($servIds as $index => $servId) {
                $sale->services()->attach($servId, ['quantity' => $servQtys[$index]]);
            }
        }
        session()->flash('complete_data');
        return redirect('sales_data/' . $sale->id);
    }
    public function completeSalesData($id)
    {
        $sale = Sale::findOrFail($id);
        $admins = User::role('Administrator')->get();

        session()->flash('complete_data');
        return view('sales.complete_sales_data', compact('sale', 'admins'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required|numeric'
        ]);

        $sale = Sale::create([
            'client_id' => $request->client_id
        ]);

        return redirect('choose_items_of_sale/' . $sale->id);
    }

    public function storeSalesData(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:sales,reference_number,' . $id,
        ]);

        $attrs = $request->only(['title', 'date', 'delivery_date', 'valid_until', 'email_sent_date', 'currency', 'payment_option', 'bank_account', 'status', 'agent', 'discount', 'billing_address', 'comments', 'private_comments', 'subtotal', 'total', 'created_by']);

        $attrs['reference_number'] = 'SO' . $request->reference_number;

        $sale->update($attrs);
        session()->flash('Update', 'تم تحديث البيانات بنجاح');
        return redirect('/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }
    public function destroy(Request $req)
    {
        $sale = Sale::findOrFail($req->id);
        $sale->products()->detach();
        $sale->services()->detach();
        $sale->delete();
        session()->flash('Delete');
        return redirect('/sales');
    }
}
