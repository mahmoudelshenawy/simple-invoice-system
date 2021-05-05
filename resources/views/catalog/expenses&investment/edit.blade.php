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
                <h4 class="content-title mb-0 my-auto"> <a href="/catalog/expenses&investment" class="content-title">النفقات و الاستثمارات</a>
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل نفقه/استثمار</span>
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
                    <form action="{{ route('expenses_investment.update',  $exp->id) }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">نفقه او استثمار</label>
                                <select class="form-control select2-no-search @error('type') is-invalid @enderror" id="typeEAI" name="type">
                                    <option value="">حدد النوع اولا</option>
                                    <option value="expense" {{$exp->type == 'expense' ? 'selected' : ''}}>Expense</option>
                                    <option value="investment"  {{$exp->type == 'investment' ? 'selected' : ''}}>investment</option>
                                </select>    
                                    @error('type')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                @php
                                $ref = substr($exp->reference_number, 3);
                               @endphp
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="number" class="form-control @error('reference_number') is-invalid @enderror" id="inputName" name="reference_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{$ref}}">
                                   
                                    @error('reference_number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label>الاسم</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder=""
                                    type="text" value="{{$exp->name}}">
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label>سعر البيع</label>
                                <input class="form-control @error('sales_price') is-invalid @enderror" name="sales_price" placeholder=""
                                    type="number" value="{{$exp->sales_price}}">
                                    @error('sales_price')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div> 
                           {{-- 2 --}}
                           <div class="row">
                            <div class="col">
                                <label for="sectionIDs" class="control-label">الفئه و التصنيف</label>
                                <select class="form-control select2-no-search @error('category_id') is-invalid @enderror" id="sectionIDs" name="category_id">
                                    <option value="val">حدد الفئة</option>
                                    <input type="hidden" name="selected_cat_id" id="selected_cat_id" value="{{$exp->category_id}}">
                                </select>
                                @error('category_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="col">
                                <label for="tax" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="tax" id="tax" class="form-control @error('tax') is-invalid @enderror" onchange="">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد نسبة الضريبة</option>
                                    <option value=" 5%" {{$exp->tax == '5%' ? 'selected' : ''}}>5%</option>
                                    <option value="10%" {{$exp->tax == '10%' ? 'selected' : ''}}>10%</option>
                                    <option value="20%" {{$exp->tax == '20%' ? 'selected' : ''}}>20%</option>
                                </select>
                                @error('tax')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div> 
                        {{-- 3 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="description" rows="3">{{$exp->description}}</textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="image" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>

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

       var type = $('#typeEAI').val()
                 $.ajax({
                        url: `/type_of_EAI/${type}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="category_id"]').empty();
                            var html = '';
                            $.each(data, function(key, value) {
                                 html += `<option value="${value.id}">${value.name}</option>`
                                $('select[name="category_id"]').html(html);
                            });
                        },
                    });
    </script>

    <script>
 $('#typeEAI').on('change' , function(e){
                 var type = e.target.value
                    $.ajax({
                        url: `/type_of_EAI/${type}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="category_id"]').empty();
                            var html = '';
                            $.each(data, function(key, value) {
                                 html += `<option value="${value.id}">${value.name}</option>`
                                $('select[name="category_id"]').html(html);
                            });
                        },
                    });
 })
    </script>
@endsection
