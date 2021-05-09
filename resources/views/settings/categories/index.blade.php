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
                <h4 class="content-title mb-0 my-auto">الأقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الأقسام</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('delete_section'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف القسم بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('update_section'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل القسم بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif
    @if (session()->has('add_section'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session('add_section')}}",
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
                                class="fas fa-plus"></i>&nbsp; اضافة قسم</a>
                    @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">إسم القسم</th>
                                    <th class="border-bottom-0">النوع/الفئة</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($categories as $cat)
                                    @php
                                    $i++
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $cat->name }} </td>
                                        <td>{{ $cat->type }}</td>
                                        <td>{{ $cat->parent->name ?? '--Primary--' }}</td>
                                        <td>
                                            @can('control_purchase_orders')
                                            <a href="#editCategoryModal" class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $cat->id }}" data-name="{{ $cat->name }}"
                                                data-description="{{ $cat->description }}" data-type="{{$cat->type}}" data-parent_id="{{$cat->parent_id}}"
                                                data-toggle="modal"
                                                 title="تعديل"><i class="las la-pen"></i></a>
                                        @endcan

                                        @can('control_purchase_orders')
                                            <a  href="#deleteSectionModal" class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $cat->id }}" data-name="{{ $cat->name }}"
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

         <!-- اضافة قسم -->
    <div class="modal" id="addSectionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم القسم</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                            <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم فئة</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="">حدد فئة</option>
                                <option value="products">Products</option>
                                <option value="services">Services</option>
                                <option value="expense">Expenses</option>
                                <option value="investment">Investment</option>
                            </select>
                            @error('type')
                             <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                              </span>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">القسم الرئيسي</label>
                            <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                <option value="">حدد القسم</option>
                                @php
                                    $cats = \App\Category::where('parent_id',null)->get();
                                @endphp
                                @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>    
                            @error('parent_id')
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
         <!-- تعديل قسم -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">تعديل القسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/settings/categories/update" method="post" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم القسم</label>
                        <input type="text" class="form-control" id="name_edit" name="name">
                        <input type="hidden"id="id_edit" name="id">
                        @error('name')
                        <span class="text-danger" role="alert">
                               <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم فئة</label>
                        <select name="type" id="type_edit" class="form-control @error('type') is-invalid @enderror">
                            <option value="">حدد فئة</option>
                            <option value="products">Products</option>
                            <option value="services">Services</option>
                            <option value="expenses">Expenses</option>
                            <option value="investment">Investment</option>
                        </select>
                        @error('type')
                         <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                          </span>
                         @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">القسم الرئيسي</label>
                        <select name="parent_id" id="parent_id_edit" class="form-control @error('parent_id') is-invalid @enderror">
                            <option value="">حدد القسم</option>
                            @php
                                $cats = \App\Category::where('parent_id',null)->get();
                            @endphp
                            @foreach ($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>    
                        @error('parent_id')
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

 <!-- delete -->
 <div class="modal" id="deleteSectionModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="/settings/categories/destroy" method="post">
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
        $('#editCategoryModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var type = button.data('type')
            var parent_id = button.data('parent_id')
            var modal = $(this)
            modal.find('.modal-body #id_edit').val(id);
            modal.find('.modal-body #name_edit').val(name);
            modal.find('.modal-body #type_edit').val(type);
            modal.find('.modal-body #parent_id_edit').val(parent_id);
        })
    
    </script>
    
    <script>
        $('#deleteSectionModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id_delete').val(id);
            modal.find('.modal-body #name_delete').val(name);
        })
    
    </script>

@endsection
