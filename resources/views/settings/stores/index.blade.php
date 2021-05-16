@extends('layouts.master')
@section('title')
    قائمة المخازن
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
                <h4 class="content-title mb-0 my-auto">المخازن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    المخازن</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف المخزن بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل المخزن بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة المخزن بنجاح",
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
                <div class="card-header pb-0">
                    @can('control_purchase_orders')
                        <a data-target="#addSectionModal" data-toggle="modal" href="#!" data-effect="effect-scale"  class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة مخزن</a>
                    @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">إسم المخزن</th>
                                    <th class="border-bottom-0">العنوان</th>
                                    <th class="border-bottom-0">رقم الهاتف</th>
                                    <th class="border-bottom-0"> رقم الهاتف الاضافى</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($stores as $store)
                                    @php
                                    $i++
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $store->name }} </td>
                                        <td>{{ $store->address }}</td>
                                        <td>{{ $store->phone_1 }}</td>
                                        <td>{{ $store->phone_2 }}</td>
                                        <td>
                                            @can('control_purchase_orders')
                                            <a href="#editStoreModal" class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $store->id }}" data-name="{{ $store->name }}"
                                                data-address="{{ $store->address }}" data-phone_1="{{$store->phone_1}}" data-phone_2="{{$store->phone_2}}"
                                                data-toggle="modal"
                                                 title="تعديل"><i class="las la-pen"></i></a>
                                        @endcan

                                        @can('control_purchase_orders')
                                            <a  href="#deleteStoreModal" class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $store->id }}" data-name="{{ $store->name }}"
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
        <!--/div-->

         <!-- اضافة مخزن -->
    <div class="modal" id="addSectionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة مخزن</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('stores.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المخزن</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                            <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان المخزن</label>
                            <input type="text" class="form-control" id="address" name="address">
                            @error('address')
                            <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم الهاتف</label>
                            <input type="text" class="form-control" id="phone_1" name="phone_1">
                            @error('phone_1')
                            <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم الهاتف الاضافى</label>
                            <input type="text" class="form-control" id="phone_2" name="phone_2">
                            @error('phone_2')
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
         <!-- تعديل مخزن -->
    <div class="modal fade" id="editStoreModal" tabindex="-1" role="dialog" aria-labelledby="editStoreModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStoreModalLabel">تعديل المخزن</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/settings/stores/update" method="post" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم المخزن</label>
                        <input type="text" class="form-control" id="name_edit" name="name">
                        <input type="hidden" id="id_edit" name="id">
                        @error('name')
                        <span class="text-danger" role="alert">
                               <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان المخزن</label>
                        <input type="text" class="form-control" id="address_edit" name="address">
                        @error('address')
                        <span class="text-danger" role="alert">
                               <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">رقم الهاتف</label>
                        <input type="text" class="form-control" id="phone_1_edit" name="phone_1">
                        @error('phone_1')
                        <span class="text-danger" role="alert">
                               <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">رقم الهاتف الاضافى</label>
                        <input type="text" class="form-control" id="phone_2_edit" name="phone_2">
                        @error('phone_2')
                        <span class="text-danger" role="alert">
                               <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                  

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">ملاحظات</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
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

 <!-- delete -->
 <div class="modal" id="deleteStoreModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف المخزن</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="/settings/stores/destroy" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="id" id="id_delete" value="">
                    <input class="form-control" name="name" id="name_delete" type="text" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
        </div>
        </form>
    </div>
</div>

    </div> 
    <!-- row closed -->
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
        $('#editStoreModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var address = button.data('address')
            var phone_1 = button.data('phone_1')
            var phone_2 = button.data('phone_2')
            var modal = $(this)
            modal.find('.modal-body #id_edit').val(id);
            modal.find('.modal-body #name_edit').val(name);
            modal.find('.modal-body #address_edit').val(address);
            modal.find('.modal-body #phone_1_edit').val(phone_1);
            modal.find('.modal-body #phone_2_edit').val(phone_2);
        })
    
    </script>
    
    <script>
        $('#deleteStoreModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id_delete').val(id);
            modal.find('.modal-body #name_delete').val(name);
        })
    
    </script>

@endsection
