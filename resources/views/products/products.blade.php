@extends('layouts.master')
@section('title')
    قائمة الأقسام
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    المنتجات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('delete_product'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session('delete_product')}}",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('update_product'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session('update_product')}}",
                    type: "success"
                })
            }

        </script>
    @endif
    @if (session()->has('add_product'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session('add_product')}}",
                    type: "success"
                })
            }

        </script>
    @endif
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('اضافة منتج')
                        <a href="#addProductModal" class="modal-effect btn btn-sm btn-primary" data-toggle="modal"  data-effect="effect-scale"   style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة منتج</a>
                    @endcan

                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">إسم المنتج</th>
                                    <th class="border-bottom-0">إسم القسم</th>
                                    <th class="border-bottom-0">الوصف</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($products as $product)
                                    @php
                                    $i++
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->name }} </td>
                                        <td>{{ $product->section->section_name }} </td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            @can('تعديل قسم')
                                            <a href="#editproductModal" class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $product->id }}" data-product_name="{{ $product->name }}"
                                                data-description="{{ $product->description }}" data-section_id="{{$product->section_id}}" data-toggle="modal"
                                                 title="تعديل"><i class="las la-pen"></i></a>
                                        @endcan

                                        @can('حذف قسم')
                                            <a  href="#deleteProductModal" class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $product->id }}" data-product_name="{{ $product->name }}"
                                                data-toggle="modal"title="حذف"><i
                                                    class="las la-trash"></i></a>
                                        @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

         <!-- اضافة منتج -->
    <div class="modal" id="addProductModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المنتج</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="section_name" name="name">
                            @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="sectionIDs" class="control-label">القسم</label>
                            <select class="form-control select2-no-search @error('section_id') is-invalid @enderror" id="sectionIDs" name="section_id">
                                <option value="val">حدد القسم</option>
                           @forelse ($sections as $section)
                               <option value="{{$section->id}}">{{$section->section_name}}</option>
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
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--اضافة منتج  --}}


       <!-- تعديل منتج -->
       <div class="modal fade" id="editproductModal" tabindex="-1" role="dialog" aria-labelledby="editproductModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="editproductModalLabel">تعديل المنتج</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
   
                   <form action="products/update" method="post" autocomplete="off">
                       {{ method_field('patch') }}
                       {{ csrf_field() }}
                       <div class="form-group">
                           <input type="hidden" name="id" id="product_id" value="">
                           <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                           <input class="form-control" name="name" id="product_name_edit" type="text">
                       </div>
                       <div class="form-group">
                        <label for="sectionIDs" class="control-label">القسم</label>
                        <select class="form-control select2-no-search @error('section_id') is-invalid @enderror" id="section_id_edit" name="section_id">
                            <option value="val">حدد القسم</option>
                       @forelse ($sections as $section)
                           <option value="{{$section->id}}">{{$section->section_name}}</option>
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
                       <div class="form-group">
                           <label for="message-text" class="col-form-label">ملاحظات:</label>
                           <textarea class="form-control" id="description_edit" name="description"></textarea>
                       </div>
               </div>
               <div class="modal-footer">
                   <button type="submit" class="btn btn-primary">تاكيد</button>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
               </div>
               </form>
           </div>
       </div>
   </div>
       {{-- تعديل منتج --}}

       <!-- delete -->
       <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">حذف المنتج</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="products/destroy" method="post">
                   {{ method_field('delete') }}
                   {{ csrf_field() }}
                   <div class="modal-body">
                       <p>هل انت متاكد من عملية الحذف ؟</p><br>
                       <input type="hidden" name="id" id="pro_id" value="">
                       <input class="form-control" name="product_name" id="product_name_delete" type="text" readonly>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                       <button type="submit" class="btn btn-danger">تاكيد</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   {{-- delete --}}
    </div>        
    @endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <!--Internal  Modal js -->
    <script src="{{ asset('assets/js/modal.js') }}"></script>

    <script>
        $('#editproductModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var description = button.data('description')
            var section_id = button.data('section_id')
            var modal = $(this)
            modal.find('.modal-body #product_id').val(id);
            modal.find('.modal-body #product_name_edit').val(product_name);
            modal.find('.modal-body #description_edit').val(description);
            modal.find('.modal-body #section_id_edit').val(section_id);
        })
    
    </script>
    
    <script>
        $('#deleteProductModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #pro_id').val(id);
            modal.find('.modal-body #product_name_delete').val(name);
        })
    
    </script>

@endsection