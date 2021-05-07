@extends('layouts.master')
@section('title')
   تفاصيل النفقه
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
                <h4 class="content-title mb-0 my-auto"> <a href="/catalog/expenses_investment" class="content-title">نفقات و استثمارات</a>
                    </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تفاصيل النفقه</span>
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
                    msg: "تم اضافة النفقه بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('add_attach'))
        <script>
          window.onload = function() {
                notif({
                    msg: "تم اضافة الصوره بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('Delete_attach'))
        <script>
          window.onload = function() {
                notif({
                    msg: "تم خزف المرفق بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('error'))
        <script>
          window.onload = function() {
                notif({
                    msg: "الرجاء مراجعة البيانات",
                    type: "error"
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
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">بيانات عامة</a></li>
                                            <li><a href="#tab7" class="nav-link" data-toggle="tab">الصور و المرفقات</a></li>
                                            <li><a href="#tab8" class="nav-link" data-toggle="tab">التاريخ</a></li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- tabs content --}}
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                   <!-- Tab one -->
                                   <div class="tab-pane active" id="tab4">
                                    <div class="row row-sm ">
                                        <div class=" col-xl-5 col-lg-12 col-md-12">
                                            <div class="preview-pic tab-content">
                                              <div class="tab-pane active" id="pic-1" style="padding: 0 50px;margin-top:30px;"><img src="{{asset($exp->imagePath)}}" width="250" height="300" alt="image"/></div>
                                            </div>
                                        </div> 
                                        <!---general descriptions-->
                                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                                            <h4 class="product-title mb-1">{{$exp->name}}</h4>
                                            <p class="text-muted tx-13 mb-1">{{$exp->reference_number}}</p>
                                            <div class="rating mb-1">
                                                <div class="stars">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star text-muted"></span>
                                                </div>
                                                <span class="review-no">41 reviews</span>
                                            </div>
                                            <h6 class="price mr-2">سعر البيع: <span class="h3 ml-3 mb-1">${{$exp->sales_price}}</span></h6>
                                            
                                            <p class="product-description mr-2">تفاصيل عن النفقه:{{$exp->description}}.</p>
                                            <h6 class="price mr-2">مضاف من قبل: <span class="h3 ml-3 mb-1">{{auth()->user()->name}}</span></h6>
                                            <div class="action">
                                                <button class="add-to-cart btn btn-danger" type="button">ADD TO WISHLIST</button>
                                                <button class="add-to-cart btn btn-success" type="button">ADD TO CART</button>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                   <!-- End Tab one-->
                                    <!--Tab Four-->
                                    <div class="tab-pane" id="tab7">
                                          <!--المرفقات-->
                                          <div class="card card-statistics">
                                            @can('control_expenses','control_investments')
                                                <div class="card-body">
                                                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                    <h5 class="card-title">اضافة مرفقات</h5> 
                                                    <form method="post" action="{{ url('/attachment',['expense']) }}"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile"
                                                                name="file_name" required>
                                                                
                                                                <input type="hidden" name="exp_id" value="{{$exp->id}}">
                                                            <label class="custom-file-label" for="customFile">حدد
                                                                المرفق</label>
                                                        </div><br><br>
                                                        <button type="submit" class="btn btn-primary btn-sm "
                                                            name="uploadedFile">تاكيد</button>
                                                    </form>
                                                </div>
                                            @endcan
                                            <br>

                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th scope="col">م</th>
                                                            <th scope="col">اسم الملف</th>
                                                            <th scope="col">قام بالاضافة</th>
                                                            <th scope="col">تاريخ الاضافة</th>
                                                            <th scope="col">العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($exp->attachment as $attachment)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $attachment->file_name }}</td>
                                                                <td>{{ $attachment->user->name }}</td>
                                                                <td>{{ $attachment->created_at }}</td>
                                                                <td colspan="2">

                                                                    <a class="btn btn-outline-success btn-sm"
                                                                        href="{{ url('View_Img') }}/{{ $exp->reference_number}}/{{ $attachment->file_name }}/Expenses&Investment"
                                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                        عرض</a>

                                                                    <a class="btn btn-outline-info btn-sm"
                                                                        href="{{ url('downloadImg') }}/{{ $exp->reference_number}}/{{ $attachment->file_name }}/Expenses&Investment"
                                                                        role="button"><i
                                                                            class="fas fa-download"></i>&nbsp;
                                                                        تحميل</a>

                                                                    @can('control_expenses','control_investments')
                                                                        <button class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-file_name="{{ $attachment->file_name }}"
                                                                            data-refernce_number="{{ $exp->reference_number }}"
                                                                            data-id_file="{{ $attachment->id }}"
                                                                            data-target="#delete_file">حذف</button>
                                                                    @endcan

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    </tbody>
                                                </table>
<!-- delete -->
<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('delete_pro_attachment',['type' => 'expense']) }}" method="post">

            {{ csrf_field() }}
            <div class="modal-body">
                <p class="text-center">
                <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                </p>

                <input type="hidden" name="id_file" id="id_file" value="">
                <input type="hidden" name="file_name" id="file_name" value="">
                <input type="hidden" name="reference_number" id="reference_number" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>
        </form>
    </div>
</div>
</div>
                                            </div>
                                        </div>
                                       </div>  
                                    <!--End of Tab Four-->

             {{-- Tab of history 5 --}}
        <div class="tab-pane" id="tab8">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>الرقم الضريبى</th>
                            <th>اسم الملف</th>
                            <th>اسم المورد/العميل</th>
                            <th>القيمة</th>
                            <th>تعديل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchase_orders as $order)
                            <tr>
                                <td>
                                    {{$order->reference_number??''}}
                                </td>
                                <td>
                                    {{$order->title ?? ''}}
                                </td>
                                <td>
                                    {{$order->supplier->name ??''}}
                                </td>
                                <td>
                                    {{$order->total ??''}}
                                </td>
                                <td>
                                    <a href="/purchase_orders">View</a>
                                </td>
                            </tr>
                        @empty 
                        @endforelse
                        @forelse ($purchase_invoices as $order)
                            <tr>
                                <td>
                                    {{$order->reference_number??''}}
                                </td>
                                <td>
                                    {{$order->title ?? ''}}
                                </td>
                                <td>
                                    {{$order->supplier->name ??''}}
                                </td>
                                <td>
                                    {{$order->total ??''}}
                                </td>
                                <td>
                                    <a href="/purchase_invoices">View</a>
                                </td>
                            </tr>
                        @empty 
                        @endforelse
                    </tbody>            
                </table>
            </div>        
        
        </div>   
                                    {{-- end of tab --}}                        

                                </div>        
   <br>
                            </div>
                       
                           
                        </div>
                    </div>            
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    </div>
   
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

        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var reference_number = button.data('reference_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #reference_number').val(reference_number);
        })
        
    </script>

  
@endsection
