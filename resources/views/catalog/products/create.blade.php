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
                <h4 class="content-title mb-0 my-auto"> <a href="/catalog/products" class="content-title">المنتجات</a>
                    </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة منتج</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
        <script>
          window.onload = function() {
                notif({
                    msg: "تم اضافة المنتج بنجاح",
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
                            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"
                                 autocomplete="off">
                                @csrf
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">بيانات عامة</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">بيانات تجارية</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">الكمية</a></li>
                                            <li><a href="#tab7" class="nav-link" data-toggle="tab">الصور و المرفقات</a></li>
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
                                           <label for="inputName" class="control-label">رقم المنتج[PRO/]</label>
                                           <input type="number" class="form-control @error('reference_number') is-invalid @enderror" id="inputName" name="reference_number" value="{{old('reference_number')}}">
                                              
                                               @error('reference_number')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                       </div>
           
                                       <div class="col">
                                           <label>اسم المنتج</label>
                                           <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder=""
                                               type="text" value="{{ old('name') }}">
                                               @error('name')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                       </div>
           
                                       <div class="col">
                                           <label>الباركود</label>
                                           <input class="form-control @error('barcode') is-invalid @enderror" name="barcode" placeholder=""
                                               type="number" value="{{old('barcode')}}">
                                               @error('barcode')
                                               <span class="text-danger" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                       </div>
           
                                   </div> 
                                     <br>
                                   {{-- 2 --}}
                                   @php
                                       $categories = \App\Category::where('type','products')->get();
                                   @endphp
                                   <div class="row">
                                       <div class="col">
                                        <label>الفئة</label>
                                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="">حدد الفئة</option>
                                          @foreach ($categories as $cat)
                                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                                          @endforeach
                                        </select>
                                            @error('category_id')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                       </div>
                                       <div class="col">
                                           <label for="Rate_VAT" class="control-label">الوصف</label>
                                           <input type="text"  name="description" id="" class="form-control form-control-lg" placeholder=''>
                                           @error('description')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                       @enderror
                                       </div>
                                   </div> 
                                   <br>
                                 
                                   <div class="custom-controls-stacked">
                                      <label class="ckbox mg-b-10"><input name="inactive" type="checkbox" value="false"><span>Inactive</span></label>
                                  </div>
<br>
                                 
                             </div>
                               
                                   <!-- End Tab one-->

                                   <!--Tab Two-->
                                   <div class="tab-pane" id="tab5">
                                       {{-- 1 --}}
                                   <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">سعر البيع</label>
                                        <input type="number" class="form-control @error('sales_price') is-invalid @enderror" id="inputName" name="sales_price" value="0.00"
                                            title="يرجي ادخال رقم المنتج" value="{{old('sales_price')}}">
                                           
                                            @error('sales_price')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="inputName" class="control-label">سعر الشراء</label>
                                        <input type="number" class="form-control @error('purchase_price') is-invalid @enderror" id="inputName" name="purchase_price" value="0.00"
                                            title="يرجي ادخال رقم المنتج" value="{{old('purchase_price')}}">
                                           
                                            @error('purchase_price')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col">
                                        <label for="inputName" class="control-label">الخصم(%)</label>
                                        <input type="number" class="form-control @error('discount') is-invalid @enderror" id="inputName" name="discount" value="0.00"
                                            title="يرجي ادخال رقم المنتج" value="{{old('discount')}}">
                                           
                                            @error('discount')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="inputName" class="control-label">TAX(%)</label>
                                        <select name="tax" id="tax" class="form-control @error('tax') is-invalid @enderror">
                                            <option value="0.00">حدد قيمة الضريبة المضافة</option>
                                            <option value="0.05">5%</option>
                                            <option value="0.1">10%</option>
                                            <option value="0.2">20%</option>
                                        </select>    
                                            @error('tax')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  <br>
                                   </div>   
                                   </div>
                                   <!--End Of Tab Two-->
                                   <!--Tab Three-->
                                   <div class="tab-pane" id="tab6">
                                 {{-- 1 --}}
                                 <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الكمية</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="inputName" name="stock"
                                            title="يرجي ادخال رقم العميل" value="0">
                                           
                                            @error('stock')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col">
                                        <label>الحد الأدنى للكمية</label>
                                        <input class="form-control @error('min_stock') is-invalid @enderror" name="min_stock" placeholder=""
                                            type="number" value="0">
                                            @error('min_stock')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="col align-self-center mt-10">
                                        <div class="custom-controls-stacked ">
                                            <label class="ckbox mg-b-10"><input checked="" value="1" name="managed_stock" type="checkbox"><span>التحكم بكميات المنتج</span></label>
                                        </div>
                                    </div>
        
                                </div> 
                                  <br>
                                   <!--End Of Tab Three-->
                                    </div>
                                    <!--Tab Four-->
                                    <div class="tab-pane" id="tab7">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 mx-auto">
                                                <input type="file" name="image" class="dropify" data-height="200" data-width="200"/>
                                            </div>
                                          </div>
                                       </div>  
                                    <!--End of Tab Four-->
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
   <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
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

  
@endsection
