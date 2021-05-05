<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return view('catalog.services.index', compact('services'));
    }


    public function create()
    {
        return view('catalog.services.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:services,reference_number',
            'name' => 'required'
        ]);

        $attrs = $request->only(['name', 'purchase_price', 'sales_price', 'description', 'discount', 'tax', 'min_price']);
        $attrs['reference_number'] = 'SER' . $request->reference_number;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $attrs['image'] = $file_name;
            // save the image
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path("Attachments/Services/" . $attrs['reference_number']), $imageName);
        }

        $service = Service::create($attrs);
        session()->flash('Add', 'تم اضافة الخدمة بنجاح');
        return back();
    }

    public function show(Service $service)
    {
        $purchase_orders = $service->purchaseOrders;
        $purchase_invoices = $service->purchaseInvoices;
        $sales = $service->sales;
        $invoices = $service->invoices;
        return view('catalog.services.ser-details', compact('service', 'purchase_orders', 'purchase_invoices', 'sales', 'invoices'));
    }
    public function edit(Service $service)
    {
        return view('catalog.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'reference_number' => 'required|numeric|unique:services,reference_number,' . $service->id,
            'name' => 'required'
        ]);

        $attrs = $request->only(['name', 'purchase_price', 'sales_price', 'description', 'discount', 'tax', 'min_price']);
        $attrs['reference_number'] = 'SER' . $request->reference_number;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $attrs['image'] = $file_name;
            // save the image
            $imageName = $request->image->getClientOriginalName();
            //remove the old image
            if (Storage::disk('public_uploads')->exists('/Services/' . $attrs['reference_number'] . '/' . $imageName)) {
                Storage::disk('public_uploads')->delete('/Services' . $attrs['reference_number'] . '/' . $imageName);
            }
            $request->image->move(public_path("Attachments/Services/" . $attrs['reference_number']), $imageName);
        }

        $service->update($attrs);
        session()->flash('Update', 'تم تحديث المنتج بنجاح');
        return redirect('/catalog/services');
    }

    public function destroy(Request $request)
    {
        $service = Service::findOrFail($request->id);
        if ($service->image !== null || count($service->attachment) > 0) {
            $path = "/Services/" . $service->reference_number;
            Storage::disk('public_uploads')->deleteDirectory($path);
            $service->deleteAttachs();
        }
        $service->delete();
        session()->flash('Delete', 'تم حدف الخدمه بنجاح');
        return back();
    }
}
