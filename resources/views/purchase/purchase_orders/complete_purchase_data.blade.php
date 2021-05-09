@extends('layouts.master')
@section('title')
   إضافة عملاء
@stop
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}"> --}}
     <!--Internal   Notify -->
     <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> <a href="/purchase_orders" class="content-title">قائمة الشراءات</a>
                </h4>
                <span class="content-title"><a href="/choose_items_of_purchase_order/{{$purchase->id}}" class=" mt-1 tx-13 mr-2 mb-0">/ إضافة المنتجات للشراء</a></span>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ استكمال بيانات الشراء</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@if (session()->has('complete_data'))
<script>
    window.onload = function() {
          notif({
              msg: "من فضلك قم بإستكمال البيانات",
              type: "success"
          })
      }
  </script>
@endif
    @if (count($errors->all()) > 0)
    <script>
        window.onload = function() {
              notif({
                  msg: "الرجاء مراجعة البيانات",
                  type: "error"
              })
          }
      </script>
    @endif
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    {{-- tabs wrapper --}}
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">المنتجات و الاجمالى</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">بيانات تجارية</a></li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- tabs content --}}
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                   <!-- Tab one -->
                                   <div class="tab-pane active" id="tab4">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>الخصم(%)</th>
                                                    <th>سعر البيع</th>
                                                    <th>الكمية</th>
                                                    <th>القيمة</th>
                                                    <th>تعديل</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal =0;
                                                    $total = 0;
                                                    $discount = 0;
                                                @endphp
                                                @foreach ($purchase->products as $product)
                                                <tr>
                                                    <th scope="row">{{$product->name}}</th>
                                                    <td>{{$product->discount}}</td>
                                                    <td>{{$product->sales_price}}</td>
                                                    <td>{{$product->pivot->quantity}}</td>
                                                    <td>
                                                        @if ($product->discount == 0)
                                                        @php  $subtotal += $product->sales_price * $product->pivot->quantity @endphp
                                                        {{$product->sales_price * $product->pivot->quantity}}
                                                        @else
                                                        {{($product->sales_price * $product->pivot->quantity) - ($product->sales_price * $product->pivot->quantity) * ($product->discount/100)}}
        
                                                        @php  $subtotal += ($product->sales_price * $product->pivot->quantity) - ($product->sales_price * $product->pivot->quantity) * ($product->discount/100) @endphp
                                                        @endif
                                                       
                                                    </td>
                                                   <td>
													<a href="/choose_items_of_purchase_order/{{$purchase->id}}" class="btn btn-sm btn-info">
														<i class="las la-pen"></i>
													</a>
                                                   </td>
                                            
                                                </tr>
                                                @endforeach
                                                @foreach ($purchase->services as $service)
                                                <tr>
                                                    <th scope="row">{{$service->name}}</th>
                                                    <td>{{$service->discount}}</td>
                                                    <td>{{$service->sales_price}}</td>
                                                    <td>{{$service->pivot->quantity}}</td>
                                                    <td>
                                                        @if ($service->discount == 0)
                                                        @php  $subtotal += $service->sales_price * $service->pivot->quantity @endphp
                                                        {{$service->sales_price * $service->pivot->quantity}}
                                                        @else
                                                        {{($service->sales_price * $service->pivot->quantity) - ($service->sales_price * $service->pivot->quantity) * ($service->discount/100)}}
        
                                                        @php  $subtotal += ($service->sales_price * $service->pivot->quantity) - ($service->sales_price * $service->pivot->quantity) * ($service->discount/100) @endphp
                                                        @endif
                                                       
                                                    </td>
                                                   <td>
													<a href="/choose_items_of_purchase_order/{{$purchase->id}}" class="btn btn-sm btn-info">
														<i class="las la-pen"></i>
													</a>
                                                   </td>
                                                      
                                                   
                                                </tr>
                                                @endforeach
                                                @foreach ($purchase->expensesInvestments as $expense)
                                                <tr>
                                                    <th scope="row">{{$expense->name}}</th>
                                                    <td>{{$expense->discount}}</td>
                                                    <td>{{$expense->sales_price}}</td>
                                                    <td>{{$expense->pivot->quantity}}</td>
                                                    <td>
                                                        @if ($expense->discount == 0)
                                                        @php  $subtotal += $expense->sales_price * $expense->pivot->quantity @endphp
                                                        {{$expense->sales_price * $expense->pivot->quantity}}
                                                        @else
                                                        {{($expense->sales_price * $expense->pivot->quantity) - ($expense->sales_price * $expense->pivot->quantity) * ($expense->discount/100)}}
        
                                                        @php  $subtotal += ($expense->sales_price * $expense->pivot->quantity) - ($expense->sales_price * $expense->pivot->quantity) * ($expense->discount/100) @endphp
                                                        @endif
                                                       
                                                    </td>
                                                   <td>
													<a href="/choose_items_of_purchase_order/{{$purchase->id}}" class="btn btn-sm btn-info">
														<i class="las la-pen"></i>
													</a>
                                                   </td>
                                                      
                                                   
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>    
                                  </div>
                                  <div class="total">
                                    <br>
                                    <br>
                                    <hr>
                                    <h1><span>VAT:20%</span>  <span>-</span> SubTotal:{{$subtotal}}</h1>   
                                    <br>
                                    @php
                                        $total = $subtotal + ($subtotal * 20/100)
                                    @endphp
                                    <h1>Total:{{$subtotal + ($subtotal * 20/100)}}</h1> 
                                  </div>
                                  <div class="d-flex justify-content-center my-3">
                                    <button type="submit" class="btn btn-primary">ملخص البيانات</button>
                                </div>
                                   </div> <!--End of Tab one-->
                                   {{-- tab Two --}}
                                   <div class="tab-pane" id="tab5">
                                          {{-- 1 --}}
                             <form action="{{ route('store_purchase_order_data', $purchase->id) }}" method="post" 
                                            autocomplete="off">
                                           @csrf
                                           <div class="row my-3">
                                            <div class="col-lg-3">
                                                <label class="rdiobox"><input checked name="type" type="radio" value="purchase_order"> <span>Purchase Order</span></label>
                                            </div>
                                            <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                <label class="rdiobox"><input  name="type" type="radio" value="delivery_note"> <span>Delivery Note</span></label>
                                            </div>
                                        </div>      
                                   <div class="row">
                                    <div class="col">
                                        @php
                                        $ref = substr($purchase->reference_number, 3);
                                    @endphp
                                        <label for="inputName" class="control-label">رقم البيع[PO/Purchase Order]</label>
                                        <input type="number" class="form-control @error('reference_number') is-invalid @enderror" id="inputName" name="reference_number" value="{{$ref}}">
                                            @error('reference_number')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label>عنوان لفاتورة البيع</label>
                                        <input class="form-control @error('title') is-invalid @enderror" name="title" placeholder=""
                                            type="text" value="{{$purchase->title}}">
                                            @error('title')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col">
                                        <label>تاريخ البيع/التسجيل</label>
                                        <input class="form-control fc-datepicker @error('date') is-invalid @enderror" name="date" placeholder="YYYY-MM-DD"
                                        type="text" value="{{ $purchase->date }}">
                                        @error('date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
        
                                </div> 
                                  <br>
                                          {{-- 2 --}}
                                   <div class="row">
                                    <div class="col">
                                        <label>تاريخ التسليم</label>
                                        <input class="form-control fc-datepicker @error('delivery_date') is-invalid @enderror" name="delivery_date" placeholder="YYYY-MM-DD"
                                        type="text" value="{{$purchase->delivery_date}}">
                                        @error('delivery_date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
        
                                    <div class="col">
                                        <label for="inputName" class="control-label">العملة</label>
                                        <select name="currency" id="currency" class="form-control @error('currency') is-invalid @enderror select2">
                                            <option value="unspecified">حدد العملة</option>
                                            @foreach (currencies() as $key=>$val)
                                            <option value="USD $ - US Dollar" selected>{{$key}}-{{$val}}</option>
                                            @endforeach
                                        </select>
                                            @error('currency')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
        
                                    <div class="col">
                                        <label>طريقة الدفع</label>
                                        <select name="payment_option" id="payment_option" class="form-control @error('payment_option') is-invalid @enderror">
                                            <option value="unspecified">حدد طريقة الدفع</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="direct_debit">direct Debit</option>
                                            <option value="check">Check</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                            @error('payment_option')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                </div> 
                                  <br>
                                          {{-- 3 --}}
                                   <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">
                                           <span class="option_order">  (طلب شراء) </span>
                                           <span class="option_delivery">(مزكرة تسليم مورد)</span>
                                            الحالة</label>
                                        <select name="status" id="status_purchase_order" class="form-control @error('status') is-invalid @enderror">
                                            <option value=""> حدد حالة طلب الشراء</option>
                                            <option value="Awaiting" class="option_order">Awaiting</option>
                                            <option value="Refused" class="option_order">Refused</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Received" class="option_order">Received</option>
                                            <option value="Pending Invoive" class="option_delivery">Pending Invoice</option>
                                            <option value="Closed" class="option_delivery">Closed</option>
                                            <option value="Invoiced" class="option_delivery">Invoiced</option>
                                        </select>
                                            @error('status')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label>المشرف</label>
                                        <select name="agent" id="agent" class="form-control @error('agent') is-invalid @enderror">
                                            <option value="unspecified">حدد المشرف</option>
                                            @foreach ($admins as $admin)
                                            <option value="{{$admin->id}}" {{$purchase->agent == $admin->id ? 'selected' : ''}}>{{$admin->name}}</option>
                                            @endforeach
                                        </select>
                                            @error('agent')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                </div> 
                                  <br>
                                          {{-- 4 --}}
                                   <div class="row">
                                    <div class="col">
                                        <label>حساب البنكى</label>
                                        <select name="bank_account" id="bank_account" class="form-control @error('bank_account') is-invalid @enderror">
                                            <option value="">حدد حساب البنكى</option>
                                            <option value="credit_bank">CREDIT BANK</option>
                                            <option value="standard">STANDARD</option>
                                        </select>
                                            @error('bank_account')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label>تاريخ اسال البريد الالكتروني</label>
                                        <input class="form-control fc-datepicker @error('email_sent_date') is-invalid @enderror" name="email_sent_date" placeholder="YYYY-MM-DD"
                                        type="text" value="{{$purchase->email_sent_date}}">
                                        @error('email_sent_date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label>تعليقات</label>
                                        <input class="form-control @error('comments') is-invalid @enderror" name="comments" 
                                        type="text" value="{{$purchase->comments}}">
                                        @error('comments')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                                   <div class="col">
                                        <label>تعليقات خاصة</label>
                                        <input class="form-control @error('private_comments') is-invalid @enderror" name="private_comments" 
                                        type="text" value="{{$purchase->private_comments}}">
                                        @error('private_comments')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div> 
                                  <br>
                                  {{-- some hidden inputs --}}
                                  <input type="hidden" name="subtotal" value="{{$subtotal}}">
                                  <input type="hidden" name="total" value="{{$total}}">
                                  <input type="hidden" name="discount" value="{{$discount}}">
                                  <input type="hidden" name="created_by" value="{{auth()->user()->name}}">
                                  <div class="d-flex justify-content-center my-3">
                                    <button type="submit" class="btn btn-primary">تحديث البيانات</button>
                                </div>

                            </form>
                                   </div>  
                                   {{-- End of tab Two --}}
                                
                                </div>
                                </div> 
                            </div>  
                             
                        </div>  
                    </div>            
                </div>
            </div>          
        </div>
    </div>         

  <!-- main-content closed -->
  @endsection
  @section('js')
     <!-- Internal Select2 js-->
     <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
     <!--Internal Fileuploads js-->
     <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
     <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
     <!--Internal Fancy uploader js-->
     <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
     <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
     <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
     <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
     <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
     <!--Internal  Form-elements js-->
     <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
     <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
     <!--Internal Sumoselect js-->
     <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
     <!--Internal  Datepicker js -->
     <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
     <!--Internal  jquery.maskedinput js -->
     {{-- <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script> --}}
     <!--Internal  spectrum-colorpicker js -->
     {{-- <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script> --}}
     <!-- Internal form-elements js -->
     <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
      <!--Internal  Notify js -->
      <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
      <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
  
      <script>
  
           var date = $('.fc-datepicker').datepicker({
              dateFormat: 'yy-mm-dd'
          }).val();
  
          $(document).ready(function(){
              $('#sectionIDs').on('change' , function(e){
                  var id = e.target.value
                  console.log(id)
                  if(typeof parseInt(id) == 'number'){
                  $.ajax({
                          url: `/invoices/products/${id}`,
                          type: "GET",
                          dataType: "json",
                          success: function(data) {
                              console.log(data)
                              $('select[name="product"]').empty();
                              $.each(data, function(key, value) {
                                  var html = `<option value="${value.id}">${value.name}</option>`
                                  $('select[name="product"]').html(html);
                              });
                          },
                          
                      });
                  }
              })
          })
      </script>
  
      <script>
   // calculate Total
   var purchase_type = $("input[type=radio]").val()
   if(purchase_type == 'purchase_order'){
       $('.option_delivery').addClass('d-none')
       $('.option_order').removeClass('d-none')
   }else{
    $('.option_order').addClass('d-none')
    $('.option_delivery').removeClass('d-none')
   }

   $("input[type=radio]").on('click', function(e){
      console.log(e.target.value)
      var type = e.target.value
    //   toggle status select
    if(type == 'purchase_order'){
        $('.option_delivery').addClass('d-none')
       $('.option_order').removeClass('d-none')
   }else{
    $('.option_order').addClass('d-none')
    $('.option_delivery').removeClass('d-none')
   }
     })
     
      </script>
  @endsection
  