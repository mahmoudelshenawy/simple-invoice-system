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
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة بيع جديد</span>
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
                  msg: "تم اضافة البيانات بنجاح",
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
                    <form action="{{ route('sales.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputName" class="control-label">العميل</label>
                                <select class="form-control select2-no-search @error('client_id') is-invalid @enderror" id="client_idEAI" name="client_id">
                                    <option value="">حدد العميل اولا</option>
                                    @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>    
                                    @error('client_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 d-flex justify-content-start align-items-center">
                                <a  href="#ViewProducts" class="modal-effect" data-effect="effect-scale" data-toggle="modal">حدد المنتجات او الخدمات</a>
                                <a ></a>
                                
                            </div>
                        </div> 
                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>
                    </form>
                    {{-- End form --}}

                        {{-- Modal Idea start --}}
                        <div class="modal" id="ViewProducts">
                            <div class="modal-dialog modal-lg" role="document">
                                <form action="{{ url('/view_products') }}" method="post">
                                    @csrf
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                            type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                        <div class="modal-body">
                                           <div class="row">
                                               @foreach ($products as $pro)
                                               <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                                                <div class="card" style="min-height: 300px;">
                                                    <img class="card-img-top" src="{{URL::asset($pro->imagePath)}}" alt="Card image cap" height="237">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="card-text">{{$pro->name}}</p>
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" data-id = "{{$pro->id}}" class="custom-control-input" id="product_{{$pro->id}}" name="product_id[]" value="{{$pro->id}}">
                                                                <label for="product_{{$pro->id}}" class="custom-control-label mt-1"></label>
                                                            </div>
                                                        </div>
                                                        <div class="my-2">
                                                            <input type="number" name="quantity[]" id="quantity_{{$pro->id}}" class="form-control form-control-sm" value="1" disabled hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                               @endforeach
                                           </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        {{-- End Modal --}}
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

        $("input[type=checkbox]").on('change', function(e){
            var  proId = e.target.value;
           if($('#product_' + proId).is(":checked")){
               console.log('yeah i will piss')
               $(`#quantity_${proId}`).removeAttr('disabled')
               $(`#quantity_${proId}`).removeAttr('hidden')
            //    $(`input[name=quantity_${proId}]`).removeAttr('disabled')
            //    $(`input[name=quantity_${proId}]`).removeAttr('hidden')
           }else{
            $(`#quantity_${proId}`).attr('disabled',true)
             $(`#quantity_${proId}`).attr('hidden', true)
            // $(`input[name=quantity_${proId}]`).attr('disabled',true)
            // $(`input[name=quantity_${proId}]`).attr('hidden',true)
           }
        })
    </script>

    <script>
 // calculate Total
 
    </script>
@endsection
