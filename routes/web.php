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

    // settings
    Route::resource('settings/categories', 'CategoryController');
    // Invoices
    Route::get('invoices/export', 'InvoiceController@export');
    Route::resource('invoices', 'InvoiceController');
    Route::get('choose_items_of_invoice/{id}', 'InvoiceController@chooseItemsOfInvoice');
    Route::post('add_items_to_invoice/{id}', 'InvoiceController@addItemsToInvoice')->name('add_items_to_invoice');
    Route::get('invoice_data/{id}', 'InvoiceController@completeInvoiceData');
    Route::post('invoice_data/{id}', 'InvoiceController@storeInvoiceData')->name('store_invoice_data');
    Route::get('archieved_invoices', 'InvoiceController@getArchievedInvoices');
    Route::post('restore_invoice', 'InvoiceController@restoreInvoice');
    Route::get('invoices/change_payment_status/{id}', 'InvoiceController@getChangePaymentStatus');
    Route::post('invoices/change_payment_status/{id}', 'InvoiceController@ChangePaymentStatus')->name('change_payment_status');
    Route::get('paid_invoices', 'InvoiceController@getPaidInvoices');
    Route::get('unpaid_invoices', 'InvoiceController@getUnPaidInvoices');
    Route::get('partial_paid_invoices', 'InvoiceController@getPartialPaidInvoices');

    Route::get('InvoicesDetails/{id}', 'InvoiceController@getInvoiceDetails');

    Route::get('download/{invoice_number}/{file_name}', 'InvoiceController@get_file');

    Route::get('View_file/{invoice_number}/{file_name}', 'InvoiceController@open_file');
    Route::get('print_invoice/{id}', 'InvoiceController@printInvoice');
    Route::get('MarkAsRead_all', 'InvoiceController@MarkAsRead_all')->name('MarkAsRead_all');
    Route::post('delete_file', 'InvoiceController@deleteAttachment')->name('delete_file');

    Route::resource('sections', 'SectionController');
    // Profile
    Route::get('profile/{userId}', 'ProfileController@getProfileOfUser');
    Route::get('profile/{userId}/create', 'ProfileController@createProfile');
    Route::resource('profile', 'ProfileController');

    // clients
    Route::get('clients/list', 'ClientController@viewClientsList');
    Route::resource('clients', 'ClientController');

    // Products details&attachments
    Route::resource('catalog/products', 'ProductController');
    Route::post('attachment/{type}', 'ProductController@addNewAttachment');
    Route::post('delete_pro_attachment/{type}', 'ProductController@delete_pro_attachment')->name('delete_pro_attachment');
    Route::get('downloadImg/{reference_number}/{file_name}/{directory}', 'ProductController@get_file');
    Route::get('View_Img/{reference_number}/{file_name}/{directory}', 'ProductController@open_file');
    // Services
    Route::resource('catalog/services', 'ServiceController');

    Route::resource('catalog/expenses_investment', 'ExpenseInvestmentController');

    Route::resource('catalog/clientAssets', 'ClientAssetController');
    Route::get('type_of_EAI/{type}', 'ExpenseInvestmentController@getTypeOfEAI');

    Route::resource('sales', 'SaleController');
    Route::get('choose_items_of_sale/{id}', 'SaleController@chooseItemsOfSale');
    Route::post('add_items_to_sale/{id}', 'SaleController@addItemsToSale')->name('add_items_to_sale');
    Route::get('sales_data/{id}', 'SaleController@completeSalesData');
    Route::post('sales_data/{id}', 'SaleController@storeSalesData')->name('store_sales_data');

    Route::get('suppliers/list', 'SupplierController@getSuppliersList');
    Route::resource('suppliers', 'SupplierController');

    // Purchase Order
    Route::resource('purchase_orders', 'PurchaseOrderController');
    Route::get('choose_items_of_purchase_order/{id}', 'PurchaseOrderController@chooseItemsOfPurchase');
    Route::post('add_items_to_purchase_order/{id}', 'PurchaseOrderController@addItemsToPurchase')->name('add_items_to_purchase_order');
    Route::get('purchase_order_data/{id}', 'PurchaseOrderController@completePurchaseOrderData');
    Route::post('purchase_order_data/{id}', 'PurchaseOrderController@storePurchaseOrderData')->name('store_purchase_order_data');
    Route::get('purchase_delivery_notes', 'PurchaseOrderController@getPurchaseDeliveryNotes');

    // Purchase Invoice
    Route::resource('purchase_invoices', 'PurchaseInvoiceController');
    Route::get('choose_items_of_purchase_invoice/{id}', 'PurchaseInvoiceController@chooseItemsOfPurchase');
    Route::post('add_items_to_purchase_invoice/{id}', 'PurchaseInvoiceController@addItemsToPurchase')->name('add_items_to_purchase_invoice');
    Route::get('purchase_invoice_data/{id}', 'PurchaseInvoiceController@completePurchaseInvoiceData');
    Route::post('purchase_invoice_data/{id}', 'PurchaseInvoiceController@storePurchaseInvoiceData')->name('store_purchase_invoice_data');

    // users & admins
    Route::resource('users', 'UserController');
});
Route::get('/{page}', 'AdminController@index');
