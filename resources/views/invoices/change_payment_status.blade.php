@extends('layouts.master')
@section('title')
   إضافة فواتير
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
                <h4 class="content-title mb-0 my-auto">
                    <a href="/invoices">الفواتير</a>
                    </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة فواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
        <script>
           function() {
                notif({
                    msg: "تم اضافة الفاتورة بنجاح",
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
                    <form action="{{ route('change_payment_status', $invoice->id) }}" method="post">
                        @csrf
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control readonly" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{$invoice->reference_number}}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">اجمالى الفاتورة</label>
                                <input type="text" class="form-control readonly" id="total" name="total"
                                    value="{{ $invoice->currency}}-{{$invoice->total}}" readonly>
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control" name="date"
                                    type="text" value="{{ $invoice->date }}" readonly>
                            </div>

                            

                        </div> 
                        <br>
                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label>تاريخ التعديل /الدفع</label>
                                <input class="form-control fc-datepicker @error('payment_date') is-invalid @enderror" name="payment_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{old('payment_date')}}">
                                    @error('payment_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المبلغ المدفوع</label>
                                <input type="number" class="form-control  @error('paid_amount') is-invalid @enderror" id="paid_amount" name="paid_amount"
                                    value="{{old('paid_amount')}}">
                                    @error('paid_amount')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label> الحالة</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="Paid">Paid</option>
                                    <option value="Partially_Paid">Partially Paid</option>
                                    <option value="UnPaid">UnPaid</option>
                                </select>
                                    @error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                          <br>
                          <div class="custom-controls-stacked">
                            <label class="ckbox mg-b-10"><input type="checkbox" id="set_as_paid" name="set_as_paid"><span>Set As Paid</span></label>
                        </div>
                        
                        <br>
                        <br>

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

        $('input[type=checkbox]').on('change', function(e){
            console.log(e)
            if($('input[type=checkbox]').is(':checked')){
               $('#amount_paid').attr('disabled', true)
               $('#status').attr('disabled', true)
            }else{
                $('#amount_paid').removeAttr('disabled')
               $('#status').removeAttr('disabled')
            }
        })  
    </script>

    <script>
    </script>
@endsection
