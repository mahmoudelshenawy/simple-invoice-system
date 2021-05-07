@extends('layouts.master')
@section('title')
   إضافة فواتير
@stop
@section('css')
<style>
    input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
     -webkit-appearance: none;
    margin: 0;
    }
</style>
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
                <h4 class="content-title mb-0 my-auto"> <a href="/sales" class="content-title">قائمة المبيعات</a>
                </h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة بيع جديد</span>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إختيار المنتجات /الخدمات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('choose_item'))
    <script>
        window.onload = function() {
              notif({
                  msg: "من فضلك قم بإختيار المنتجات",
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
                    <form action="{{ url("/add_items_to_sale/$sale->id") }}" method="POST" autocomplete="off">
                        @csrf
                        {{-- 1 --}}
                        <div class="row">
                           <div class="col-md-8 mx-auto">
                            <div class="text center">
                                <h4>Products</h4>
                            </div>
                            <div class="row">
                                @forelse ($products as $pro)
                                <div class="col-lg-4 col-md-3 col-12 col-sm-12 my-3">
                                 <div class="card" style="min-height: 300px;">
                                     <img class="card-img-top" src="{{URL::asset($pro->imagePath)}}" alt="Card image cap" height="237">
                                     <div class="card-body">
                                         <div class="d-flex justify-content-between">
                                             <p class="card-text">{{$pro->name}}</p>
                                             <div class="custom-checkbox custom-control">
                                                 <input type="checkbox" data-checkboxes="mygroup" data-id = "{{$pro->id}}" class="custom-control-input" id="product_{{$pro->id}}" name="product_id[]" value="{{$pro->id}}" @if ($sale->products->contains($pro)) checked @endif>
                                                 <label for="product_{{$pro->id}}" class="custom-control-label mt-1"></label>
                                             </div>
                                         </div>
                                         <div class="my-2">
                                            
                                             @if ($sale->products->contains($pro))
                                            @php
                                                $pro_sale = $sale->products->find($pro)
                                            @endphp
                                             <input type="number" name="quantity[]" id="quantity_{{$pro->id}}" class="form-control form-control-sm" value="{{$pro_sale->pivot->quantity}}">
                                             @else
                                             <input type="number" name="quantity[]" id="quantity_{{$pro->id}}" class="form-control form-control-sm" value="1" disabled hidden>
                                           @endif
                                            
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             @empty
                             <a href="/products/create">Create New products</a>
                                @endforelse
                            </div>   
                               <hr>
                               <div class="text center">
                                 <h4>Services</h4>
                                 </div>
                                 <div class="row">
                                {{-- Services --}}
                                @forelse ($services as $serv)
                                <div class="col-lg-4 col-md-3 col-12 col-sm-12 my-3">
                                 <div class="card" style="min-height: 300px;">
                                     <img class="card-img-top" src="{{URL::asset($serv->imagePath)}}" alt="Card image cap" height="237">
                                     <div class="card-body">
                                         <div class="d-flex justify-content-between">
                                             <p class="card-text">{{$serv->name}}</p>
                                             <div class="custom-checkbox custom-control">
                                                 <input type="checkbox" data-checkboxes="mygroup" data-id = "{{$serv->id}}" class="custom-control-input" id="service_{{$serv->id}}" name="service_id[]" value="{{$serv->id}}" @if ($sale->services->contains($serv)) checked @endif>
                                                 <label for="service_{{$serv->id}}" class="custom-control-label mt-1"></label>
                                             </div>
                                         </div>
                                         <div class="my-2">
                                            
                                             @if ($sale->services->contains($serv))
                                            @php
                                                $serv_sale = $sale->services->find($serv)
                                            @endphp
                                             <input type="number" name="quantity_service[]" id="quantity_serve_{{$serv->id}}" class="form-control form-control-sm" value="{{$serv_sale->pivot->quantity}}">
                                             @else
                                             <input type="number" name="quantity_service[]" id="quantity_serve_{{$serv->id}}" class="form-control form-control-sm" value="1" disabled hidden>
                                           @endif
                                            
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             @empty
                             <a href="/services/create">Create New Service</a>
                                @endforelse
                                {{-- end services --}}
                         </div>      
                           </div>
                        </div> 
                        <div class="d-flex justify-content-center my-3">
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
    <!--Internal  Modal js -->
 <script src="{{ asset('assets/js/modal.js') }}"></script>

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
                        url: `/sales/products/${id}`,
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

        $("input[type=checkbox]").on('change', function(e){
            var  id = e.target.value;
           if($('#product_' + id).is(":checked")){
               $(`#quantity_${id}`).removeAttr('disabled')
               $(`#quantity_${id}`).removeAttr('hidden')
           }else{
            $(`#quantity_${id}`).attr('disabled',true)
             $(`#quantity_${id}`).attr('hidden', true)
           }
       
           if($('#service_' + id).is(":checked")){
               $(`#quantity_serve_${id}`).removeAttr('disabled')
               $(`#quantity_serve_${id}`).removeAttr('hidden')
           }else{
            $(`#quantity_serve_${id}`).attr('disabled',true)
             $(`#quantity_serve_${id}`).attr('hidden', true)
           }
        })
    </script>

    <script>
 // calculate Total
 
    </script>
@endsection
