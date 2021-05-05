<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\User;
use Illuminate\Http\Request;
use App\Service;
use App\Product;
use App\Http\Requests\InvoiceRequest;
use App\InvoiceAttachments;
use App\InvoiceDetails;
use App\Notifications\NewInvoiceAdded;
use App\Notifications\NewInvoiceAddedEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::all();
        $clients = Client::all(['name', 'legal_name', 'id']);
        $archieved = false;
        return view('invoices.index', compact('invoices', 'archieved', 'clients'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required|numeric'
        ]);

        $invoice = Invoice::create([
            'client_id' => $request->client_id
        ]);

        return redirect('choose_items_of_invoice/' . $invoice->id);
    }

    public function chooseItemsOfInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $products = Product::all();
        $services = Service::all();
        session()->flash('choose_item');
        return view('invoices.choose_items', compact('invoice', 'products', 'services'));
    }

    public function addItemsToInvoice(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $proIds = $request->product_id;
        $servIds = $request->service_id;

        $proQtys = $request->quantity;
        $servQtys = $request->quantity_service;

        $invoice->products()->detach();
        $invoice->services()->detach();

        if (!empty($proIds)) {
            foreach ($proIds as $index => $proId) {
                $invoice->products()->attach($proId, ['quantity' => $proQtys[$index]]);
            }
        }
        if (!empty($servIds)) {
            foreach ($servIds as $index => $servId) {
                $invoice->services()->attach($servId, ['quantity' => $servQtys[$index]]);
            }
        }
        session()->flash('complete_data');
        return redirect('invoice_data/' . $invoice->id);
    }

    public function completeInvoiceData($id)
    {
        $invoice = Invoice::findOrFail($id);
        $admins = User::role('owner')->get();

        session()->flash('complete_data');
        return view('invoices.complete_invoice_data', compact('invoice', 'admins'));
    }

    public function storeInvoiceData(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:invoices,reference_number,' . $id,
        ]);

        $attrs = $request->only(['title', 'date', 'delivery_date', 'email_sent_date', 'currency', 'payment_option', 'bank_account', 'status', 'agent', 'comments', 'private_comments', 'subtotal', 'total', 'discount', 'created_by']);

        $attrs['reference_number'] = 'INV' . $request->reference_number;

        $invoice->update($attrs);
        $user = auth()->user();
        Notification::send($user, new NewInvoiceAdded($invoice));
        session()->flash('Update', 'تم تحديث البيانات بنجاح');
        return redirect('/invoices');
    }

    public function getPurchaseDeliveryNotes()
    {
        $status = ['In Progress', 'Closed', 'Pending', 'Invoiced'];
        $purchases = Invoice::whereIn('status', $status)->get();
        $suppliers = Client::all(['name', 'legal_name', 'id']);
        return view('purchase.purchase_invoices.purchase_delivery_notes', compact('purchases', 'suppliers'));
    }

    public function getArchievedInvoices()
    {
        $invoices = Invoice::onlyTrashed()->get();
        $archieved = true;
        return view('invoices.archieved', compact('invoices', 'archieved'));
    }

    public function show(Invoice $Invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $Invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $Invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $Invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $Invoice)
    {
        //
    }
    public function destroy(Request $req)
    {
        $invoice_id = $req->invoice_id;
        $invoice = Invoice::withTrashed()->where('id', $invoice_id)->first();
        //check if it is delete or archive
        // get the details and attachment if exists
        if ($req->id_page == 'delete') {
            $invoice->products()->detach();
            $invoice->services()->detach();
            $invoice->forceDelete();
            session()->flash('Delete');
            session()->flash('Delete');
            return redirect('/invoices');
        } else {
            $invoice->delete();
            session()->flash('Archieve');
            return redirect('/archieved_invoices');
        }
    }

    public function restoreInvoice(Request $request)
    {
        $invoice_id = $request->id;
        $invoice = Invoice::withTrashed()->whereId($invoice_id)->restore();
        session()->flash('Restore');
        return redirect('/invoices');
    }
}
