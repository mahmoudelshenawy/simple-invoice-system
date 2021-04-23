<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/index', function () {
        return view('index');
    });

    Route::resource('invoices', 'InvoiceController');
    Route::get('invoices/products/{id}', 'InvoiceController@getProductsOfSection');
    Route::get('paid_invoices', 'InvoiceController@getPaidInvoices');
    Route::get('unpaid_invoices', 'InvoiceController@getUnPaidInvoices');
    Route::get('partial_paid_invoices', 'InvoiceController@getPartialPaidInvoices');
    Route::get('archieved_invoices', 'InvoiceController@getArchievedInvoices');
    Route::post('restore_invoice', 'InvoiceController@restoreInvoice');
    Route::get('InvoicesDetails/{id}', 'InvoiceController@getInvoiceDetails');

    Route::get('download/{invoice_number}/{file_name}', 'InvoiceController@get_file');

    Route::get('View_file/{invoice_number}/{file_name}', 'InvoiceController@open_file');
    Route::get('print_invoice/{id}', 'InvoiceController@printInvoice');
    Route::get('MarkAsRead_all', 'InvoiceController@MarkAsRead_all')->name('MarkAsRead_all');
    Route::post('delete_file', 'InvoiceController@deleteAttachment')->name('delete_file');

    Route::resource('sections', 'SectionController');
    Route::resource('products', 'ProductController');
    // Route::resource('profile', 'ProfileController');
});
Route::get('/{page}', 'AdminController@index');
