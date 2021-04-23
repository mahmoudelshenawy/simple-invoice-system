@extends('layouts.master')
@section('title')
   تعديل فواتير
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
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
     <!--Internal   Notify -->
     <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل فواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('update_invoice'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('update_invoice') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <script>
           function() {
                notif({
                    msg: "{{ session()->get('update_invoice') }}",
                    type: "success"
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
                    <form action="{{ route('invoices.update',$invoice->id) }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        @method('put')
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{$invoice->invoice_number}}">
                                   
                                    @error('invoice_number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker @error('invoice_Date') is-invalid @enderror" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{$invoice->invoice_Date}}">
                                    @error('invoice_Date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker @error('Due_date') is-invalid @enderror" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{$invoice->Due_date}}">
                                    @error('Due_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div> 
                           {{-- 2 --}}

                           <div class="row">
                            <div class="col">
                                <label for="sectionIDs" class="control-label">القسم</label>
                                <select class="form-control select2-no-search @error('section_id') is-invalid @enderror" id="sectionIDs" name="section_id">
                                    <option value="val">--حدد القسم--</option>
                               @forelse ($sections as $section)
                                   <option value="{{$section->id}}" {{$invoice->section_id === $section->id ? 'selected' : ''}}>{{$section->section_name}}</option>
                               @empty
                                   <option value="">لا يوجد أقسام</option>
                               @endforelse
                                </select>
                                @error('section_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="col">
                                <label>المنتج</label>
                                <select class="form-control select2-no-search @error('product') is-invalid @enderror" id="productName" name="product">
                                    <option value=false>اختار القسم اولا</option>
                                </select>
                                @error('product')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="col">
                                <label for="Amount_collection" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control @error('section_id') is-invalid @enderror" id="Amount_collection" name="Amount_collection" onchange=""
                                value="{{$invoice->Amount_collection}}">

                                @error('Amount_collection')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </div> 
                        {{-- 3 --}}
                        <div class="row">
                            <div class="col">
                                <label for="AmountCommission" class="control-label">قيمة العمولة</label>
                                <input type="number" class="form-control @error('Amount_Commission') is-invalid @enderror" id="Amount_Commission" name="Amount_Commission" value="{{$invoice->Amount_Commission}}">
                                @error('Amount_Commission')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="col">
                                <label>الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    title="يرجي ادخال مبلغ الخصم " onchange=""
                                    value="{{$invoice->Discount}}">
                            </div>
                            <div class="col">
                                <label for="Rate_VAT" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control @error('Rate_VAT') is-invalid @enderror" onchange="calculateTotal()">
                                    <!--placeholder-->
                                    <option value="" disabled>حدد نسبة الضريبة</option>
                                    <option value="5%" {{$invoice->Rate_VAT == '5%' ? 'selected' : ''}}>5%</option>
                                    <option value="10%" {{$invoice->Rate_VAT == '10%' ? 'selected' : ''}}>10%</option>
                                </select>
                                @error('Rate_VAT')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </div> 

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="Value_VAT" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" value="{{$invoice->Value_VAT}}" readonly>
                            </div>

                            <div class="col">
                                <label for="Total" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" value="{{$invoice->Total}}" readonly>
                            </div>
                        </div>
                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{$invoice->note}}</textarea>
                            </div>
                        </div><br>

                        <!--
                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>
                        -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>
                    </form>
                    {{-- End form --}}
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
   <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
   <!--Internal  spectrum-colorpicker js -->
   <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
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
            var section_id = $('#sectionIDs').val();
            if(typeof parseInt(section_id) == 'number'){
                $.ajax({
                        url: `/invoices/products/${section_id}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                var html = `<option value="${value.id}">${value.name}</option>`
                                $('select[name="product"]').html(html);
                            });
                        },
                        
                    });
            }
            $('#sectionIDs').on('change' , function(e){
                var id = e.target.value
                if(typeof parseInt(id) == 'number'){
                $.ajax({
                        url: `/invoices/products/${id}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
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
