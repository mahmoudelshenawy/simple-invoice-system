<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use Illuminate\Http\Request;
use App\Section;
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


    public function create()
    {
        $sections = Section::all(['id', 'section_name']);
        return view('invoices.create', compact('sections'));
    }

    public function getProductsOfSection($id)
    {
        $products = Product::where('section_id', $id)->get();
        return response()->json($products);
    }

    public function store(InvoiceRequest $request)
    {
        // validate

        //create new invoice
        $request_attr = $request->only([
            'invoice_number',
            'invoice_Date', 'Due_date', 'product', 'section_id', 'Amount_collection', 'Amount_Commission', 'Discount', 'Value_VAT', 'Rate_VAT', 'Total', 'note'
        ]);
        $request_attr['Status'] =  'غير مدفوعة';
        $request_attr['Value_Status'] =  2;

        DB::beginTransaction();

        $newInvoice = Invoice::create($request_attr);
        // create new invoice detail
        $invoiceDetails = InvoiceDetails::create([
            'invoice_id' => $newInvoice->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => auth()->user()->name
        ]);

        // add Attachment If Exist
        if ($request->hasFile('pic')) {

            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number =  $request->invoice_number;
            $attachment = InvoiceAttachments::create([
                'file_name' => $file_name,
                'invoice_number' => $request->invoice_number,
                'created_by' => auth()->user()->name,
                'invoice_id' => $newInvoice->id
            ]);
            // save the image
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }
        $user = auth()->user();
        if ($newInvoice && $invoiceDetails) {
            DB::commit();
            // send notification to admin through mail
            // store notification to database
            $user->notify(new NewInvoiceAddedEmail($newInvoice));
            Notification::send($user, new NewInvoiceAdded($newInvoice));
        } else {
            DB::rollBack();
        }
        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }


    public function show(Invoice $invoice)
    {
        //
    }

    public function edit(Invoice $invoice)
    {
        $sections = Section::all(['id', 'section_name']);
        return view('invoices.edit', compact('invoice', 'sections'));
    }


    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        // validate

        //update invoice
        $request_attr = $request->only([
            'invoice_number',
            'invoice_Date', 'Due_date', 'product', 'section_id', 'Amount_collection', 'Amount_Commission', 'Discount', 'Value_VAT', 'Rate_VAT', 'Total', 'note'
        ]);
        $request_attr['Status'] =  'غير مدفوعة';
        $request_attr['Value_Status'] =  2;

        DB::beginTransaction();

        $invoice->update($request_attr);
        // update invoice detail
        $invoiceDetailUpdate = InvoiceDetails::where('invoice_id', $invoice->id)->first();
        if ($invoiceDetailUpdate) {
            $invoiceDetailUpdate->update([
                'invoice_id' => $invoice->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section_id' => $request->section_id,
                'Status' => 'غير مدفوعة',
                'Value_Status' => 2,
                'note' => $request->note,
                'user' => auth()->user()->name
            ]);
        }
        DB::commit();
        session()->flash('update', 'تم تعديل الفاتورة بنجاح');
        return redirect('invoices');
        // send notification to admin
    }

    public function destroy(Request $request, $id)
    {
        $invoice_id = $request->invoice_id;
        $invoice = Invoice::where('id', $invoice_id)->first();
        //check if it is delete or archive
        // get the details and attachment if exists
        $invoiceDetails = InvoiceDetails::where('invoice_id', $invoice_id)->first();
        $invoiceAttachments = InvoiceAttachments::where('invoice_id', $invoice_id)->first();

        if ($request->id_page != 2) {
            if (!empty($invoiceAttachments->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($invoiceAttachments->invoice_number);
                $invoice->forceDelete();
                session()->flash('delete_invoice', 'تم حدف الفاتورة');
                return redirect('/invoices');
            }
        } else {
            $invoice->delete();
            session()->flash('archive_invoice', 'تم ارشفة الفاتورة');
            return redirect('/archives');
        }
    }

    public function getPaidInvoices()
    {
        $invoices = Invoice::where('Value_Status', 1)->get();
        $archieved = false;
        return view('invoices.invoices', compact('invoices', 'archieved'));
    }
    public function getUnPaidInvoices()
    {
        $invoices = Invoice::where('Value_Status', 2)->get();
        $archieved = false;
        return view('invoices.invoices', compact('invoices', 'archieved'));
    }
    public function getPartialPaidInvoices()
    {
        $invoices = Invoice::where('Value_Status', 3)->get();
        $archieved = false;
        return view('invoices.invoices', compact('invoices', 'archieved'));
    }
    public function getArchievedInvoices()
    {
        $invoices = Invoice::onlyTrashed()->get();
        $archieved = true;
        return view('invoices.invoices', compact('invoices', 'archieved'));
    }

    public function restoreInvoice(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $invoice = Invoice::withTrashed()->whereId($invoice_id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    public function getInvoiceDetails($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $details  = InvoiceDetails::where('invoice_id', $id)->get();
        $attachments  = InvoiceAttachments::where('invoice_id', $id)->get();
        return view('invoices.invoice_details', compact('invoices', 'details', 'attachments'));
    }

    public function get_file($invoice_number, $file_name)

    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }



    public function open_file($invoice_number, $file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($files);
    }

    public function deleteAttachment(Request $request)
    {
        $invoices = InvoiceAttachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function printInvoice($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.Print_invoice', compact('invoices'));
    }

    public function MarkAsRead_all(Request $request)
    {

        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }


    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification) {

            return $notification->data['title'];
        }
    }
}
