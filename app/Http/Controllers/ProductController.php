<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Section;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('catalog.products.index', compact('products'));
    }


    public function create()
    {
        return view('catalog.products.create');
    }

    public function store(ProductRequest $request)
    {
        $attrs = $request->only(['name', 'purchase_price', 'sales_price', 'barcode', 'category_id', 'inactive', 'description', 'discount', 'tax', 'min_price', 'stock', 'min_stock', 'managed_stock']);
        $attrs['reference_number'] = 'PRO' . $request->reference_number;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $attrs['image'] = $file_name;
            // save the image
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path("Attachments/Products/" . $attrs['reference_number']), $imageName);
        }

        $product = Product::create($attrs);
        session()->flash('Add', 'تم اضافة المنتج بنجاح');
        return back();
    }

    public function show(Product $product)
    {

        $purchase_orders = $product->purchaseOrders;
        $purchase_invoices = $product->purchaseInvoices;
        $sales = $product->sales;
        $invoices = $product->invoices;
        // dd($purchase_orders);
        return view('catalog.products.pro-details', compact('product', 'purchase_orders', 'purchase_invoices', 'sales', 'invoices'));
    }
    public function edit(Product $product)
    {
        return view('catalog.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $attrs = $request->only(['name', 'purchase_price', 'sales_price', 'barcode', 'category_id', 'inactive', 'description', 'discount', 'tax', 'min_price', 'stock', 'min_stock', 'managed_stock']);

        $attrs['reference_number'] = 'PRO' . $request->reference_number;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $attrs['image'] = $file_name;
            $imageName = $request->image->getClientOriginalName();
            //remove the old image
            if (Storage::disk('products_uploads')->exists($attrs['reference_number'] . '/' . $imageName)) {
                Storage::disk('products_uploads')->delete($attrs['reference_number'] . '/' . $imageName);
            }

            // save the image
            $request->image->move(public_path("Attachments/Products/" . $attrs['reference_number']), $imageName);
        }

        $product->update($attrs);
        session()->flash('Update', 'تم تحديث المنتج بنجاح');
        return redirect('/catalog/products');
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->image !== null || count($product->attachment) > 0) {
            $path = "/Products/" . $product->reference_number;
            Storage::disk('public_uploads')->deleteDirectory($path);
            $product->deleteAttachs();
        }
        $product->delete();
        session()->flash('Delete', 'تم حدف المنتج بنجاح');
        return back();
    }

    public function addNewAttachment(Request $request, $type)
    {
        if ($type == 'product') {
            $product = Product::findOrFail($request->product_id);

            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
            // save the image
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path("Attachments/Products/" . $product->reference_number), $imageName);

            $product->attachment()->create([
                'file_name' => $file_name,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('add_attach');
            return back();
        } else if ($type == 'service') {
            $service = Service::findOrFail($request->service_id);
            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
            // save the image
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path("Attachments/Services/" . $service->reference_number), $imageName);
            $service->attachment()->create([
                'file_name' => $file_name,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('add_attach');
            return back();
        }
        session()->flash('error');
        return back();
    }

    public function get_file($ref_number, $file_name, $directory)

    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($directory . '/' . $ref_number . '/' . $file_name);
        return response()->download($contents);
    }



    public function open_file($ref_number, $file_name, $directory)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($directory . '/' . $ref_number . '/' . $file_name);
        return response()->file($files);
    }

    public function delete_pro_attachment(Request $request, $type)
    {
        if ($type == 'product') {
            $product = Product::where('reference_number', $request->reference_number)->first();
            // remove attach from db
            $attachment = Attachment::where('id', $request->id_file)->delete();
            // remove file from directory

            $file = "Attachments/Products/" . $request->reference_number . $request->file_name;
            Storage::disk('products_uploads')->delete($request->reference_number . '/' . $request->file_name);
        } else if ($type == 'service') {
            $service = Service::where('reference_number', $request->reference_number)->first();
            // remove attach from db
            $attachment = Attachment::where('id', $request->id_file)->delete();
            // remove file from directory
            // Unsolved
            $file = "public/Attachments/Services/" . $request->reference_number . $request->file_name;
            Storage::delete($file);
            Storage::disk('public_uploads')->delete("Services" . '/' . $request->reference_number . '/' . $request->file_name);
        }



        session()->flash('Delete_attach', 'تم حدف المرفق بنجاح');
        return back();
    }
}
