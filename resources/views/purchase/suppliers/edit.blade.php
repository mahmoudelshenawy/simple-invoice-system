@extends('layouts.master')
@section('title')
   تعديل مورد جديد
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
                <h4 class="content-title mb-0 my-auto"> <a href="/suppliers" class="content-title">قائمة الموردين </a>
                    </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مورد</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
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
                            <form action="{{ route('suppliers.update',$supplier->id) }}" method="post" enctype="multipart/form-data"
                                 autocomplete="off">
                                @csrf
                                @method('PUT')
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">بيانات عامة</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">بيانات تجارية</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">الحساب البنكى</a></li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- tabs content --}}
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                   <!-- Tab one -->
                                   <div class="tab-pane active" id="tab4">
                                   {{-- 1 --}}
                                   <div class="row">
                                       <div class="col">
                                        @php
                                        $ref = substr($supplier->reference_number, 3);
                                    @endphp
                                           <label for="inputName" class="control-label">رقم العميل[SUP/]</label>
                                           <input type="number" class="form-control @error('reference_number') is-invalid @enderror" id="inputName" name="reference_number" value="{{$ref}}">
                                              
                                               @error('reference_number')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                       </div>
           
                                       <div class="col">
                                           <label>الاسم التجارى</label>
                                           <input class="form-control @error('legal_name') is-invalid @enderror" name="legal_name" placeholder=""
                                               type="text" value="{{$supplier->legal_name}}">
                                               @error('legal_name')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                       </div>
           
                                       <div class="col">
                                           <label>الاسم الشخصي</label>
                                           <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder=""
                                               type="text" value="{{$supplier->name}}">
                                               @error('name')
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
                                           <label for="AmountCommission" class="control-label">الرقم الضريبي[TIN]</label>
                                           <input type="text" class="form-control @error('tin') is-invalid @enderror" id="tin" name="tin" value="{{$supplier->tin}}">
                                           @error('tin')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                       @enderror
                                       </div>
           
                                       <div class="col">
                                           <label>رقم الهاتف 1</label>
                                           <input type="text" class="form-control form-control-lg" id="phone_1" name="phone_1"
                                               value="{{$supplier->phone_1}}">
                                               @error('phone_1')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                       </div>
                                       <div class="col">
                                           <label for="Rate_VAT" class="control-label">رقم الهاتف 2</label>
                                           <input type="text" class="form-control form-control-lg" id="phone_2" name="phone_2"
                                           value="{{$supplier->phone_2}}">
                                           @error('phone_2')
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
                                           <label for="AmountCommission" class="control-label">الفاكس</label>
                                           <input type="text" class="form-control @error('fax') is-invalid @enderror" id="fax" name="fax" value="{{$supplier->fax}}">
                                           @error('fax')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                       @enderror
                                       </div>
           
                                       <div class="col">
                                           <label>البريب الالكتروني</label>
                                           <input type="email" class="form-control form-control-lg" id="email" name="email"
                                               value="{{$supplier->email}}">
                                               @error('email')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                       </div>
                                       <div class="col">
                                           <label for="Rate_VAT" class="control-label">الموقع الالكتروني</label>
                                           <input type="text" class="form-control form-control-lg" id="website" name="website"
                                           value="{{$supplier->website}}">
                                           @error('website')
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
                                           <label for="AmountCommission" class="control-label">العنوان</label>
                                           <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{$supplier->address}}">
                                           @error('address')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                       @enderror
                                       </div>
           
                                       <div class="col">
                                           <label>التعليقات</label>
                                           <input type="text" class="form-control form-control-lg" id="comments" name="comments"
                                               value="{{$supplier->comments}}">
                                               @error('comments')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                            </div>
           
                                   </div> 
                                 <br>
                                 
                             </div>
                               
                                   <!-- End Tab one-->

                                   <!--Tab Two-->
                                   <div class="tab-pane" id="tab5">
                                       {{-- 1 --}}
                                   <div class="row">
                                    <div class="col">
                                        <label>طريقة الدفع</label>
                                        <select name="payment_option" id="payment_option" class="form-control @error('payment_option') is-invalid @enderror">
                                            <option value="unspecified">حدد طريقة الدفع</option>
                                            <option value="bank_transfer" {{$supplier->payment_option == 'bank_transfer' ? 'selected' : ''}}>Bank Transfer</option>
                                            <option value="direct_debit" {{$supplier->payment_option == "direct_debit" ? 'selected' : ''}}>direct Debit</option>
                                            <option value="check" {{$supplier->payment_option == "check" ? 'selected' : ''}}>Check</option>
                                            <option value="cash" {{$supplier->payment_option == "cash" ? 'selected' : ''}}>Cash</option>
                                        </select>
                                            @error('payment_option')
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
                                            <option value="{{$admin->id}}" {{$supplier->agent == $admin->id ? 'selected' : ''}}>{{$admin->name}}</option>
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
                                       {{-- 2 --}}
                                   <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">العملة</label>
                                        <select name="currency" id="currency" class="form-control @error('currency') is-invalid @enderror">
                                            <option value="unspecified">حدد العملة</option>
                                            <option value="USD $ - US Dollar" selected>USD $ - US Dollar</option>
                                        </select>
                                            @error('currency')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col">
                                        <label>موعد الدفع</label>
                                        <select name="payment_term" id="payment_term" class="form-control @error('payment_term') is-invalid @enderror">
                                            <option value="unspecified">حدد موعد الدفع</option>
                                            <option value="immediate_payment" selected>الدفع فورى</option>
                                            <option value="30-60-90 Days Payment">دفع بالتقسيط جزئي</option>
                                        </select>
                                            @error('payment_term')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col">
                                        <label>تعديل موعد الدفع</label>
                                        <select name="payment_adjustment" id="payment_adjustment" class="form-control @error('payment_adjustment') is-invalid @enderror">
                                            <option value="unspecified">غير محدد</option>
                                            <option value="previous_than">قبل الموعد</option>
                                            <option value="later_than">متأخر عن الموعد</option>
                                            <option value="closest_to">قريب من الموعد</option>
                                        </select>
                                            @error('payment_adjustment')
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
                                        <label>خيارات اضافية</label>
                                        <div class="custom-controls-stacked">
                                            <label class="ckbox mg-b-10"><input checked="" type="checkbox"><span> Subject to VAT</span></label>
                                            <label class="ckbox"><input type="checkbox"><span>subject to income Tax</span></label>
                                        </div>
                                            @error('')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                  <br>
                                   </div>   
                                   <!--End Of Tab Two-->
                                   <!--Tab Three-->
                                   <div class="tab-pane" id="tab6">
                                 {{-- 1 --}}
                                 <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الحساب البنكى</label>
                                        <input type="text" class="form-control @error('bank_account') is-invalid @enderror" id="inputName" name="bank_account"
                                            title="يرجي ادخال رقم العميل" value="{{$supplier->bank_account}}">
                                           
                                            @error('bank_account')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col">
                                        <label>اسم البنك</label>
                                        <input class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" placeholder=""
                                            type="text" value="{{$supplier->bank_name}}">
                                            @error('bank_name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col">
                                        <label>BIC/SWIFT</label>
                                        <input class="form-control @error('BIC/SWIFT') is-invalid @enderror" name="BIC/SWIFT" placeholder=""
                                            type="text" value="">
                                            @error('BIC/SWIFT')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                </div> 
                                  <br>
                                   <!--End Of Tab Three-->
                                    </div>
                                </div>        
<br>
<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
</div>
                            </div>
                        </form>
                            <!--End form-->
                        </div>
                    </div>            
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
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
 function calculateTotal(){
    var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;
            }
 }
    </script>
@endsection
