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
                    {{-- filter --}}
								<div class="row my-2">
									<div class="col">
											<label for="inputName" class="control-label">بحث بالإسم</label>
											<input type="text" class="form-control" id="search_name" name="search_name" value="{{old('search_name')}}" placeholder="ابحث بواسطه اسم العميل او رقم الفاتورة">
									</div>
									<div class="col">
										<label>تاريخ إصدار الفاتورة</label>
										<input class="form-control fc-datepicker" name="search_date" placeholder="YYYY-MM-DD"
											type="text" value="" id="search_date">
									</div>
									<div class="col">
										<label>تاريخ التحصيل الفاتورة</label>
										<input class="form-control fc-datepicker" name="search_by_due_date" placeholder="YYYY-MM-DD"
											type="text" value="{{ date('Y-m-d') }}" id="search_by_due_date">
									</div>
								</div>
                    <div class="table-responsive">
                        <table id="categoryTable" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="wd-lg-5p"><span>#</span></th>
                                    <th class="wd-lg-10p"><span>رقم الفاتورة</span></th>
                                    <th class="wd-lg-20p"><span>اسم العميل</span></th>
                                    <th class="wd-lg-10p"><span>الحالة</span></th>
                                    <th class="wd-lg-10p"><span>الأجمالى</span></th>
                                    <th class="wd-lg-10p"><span>مضاف بواسطة</span></th>
                                    <th class="wd-lg-15p"><span>تاريخ الفاتورة</span></th>
                                    <th class="wd-lg-25p">العمليات</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
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
    <!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>

  <script>
      // End filter
	   var date = $('.fc-datepicker').datepicker({
              dateFormat: 'yy-mm-dd',
          }).val();
 $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

$(document).ready(function(){
    var table = $('#categoryTable').DataTable({
    lengthChange: false,
		"sDom": "rtipl",
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_',
		},
         processing: true,
         serverSide: true,
         searching: true,
        dom: 't',
         ajax: {
          url: '/demo',
          type: 'GET',
          data : function (data) {
            var name = $('#search_name').val();
            var date = $('#search_date').val();
          // Append to data
          data.search_name = name;
          data.search_date = date;
            }
         },
         columns: [
                 { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                  {data: 'reference_number', name: 'reference_number'},
                  {data: 'client', name: 'client'},
                  {data: 'status', name: 'status'},
                  {data: 'total', name: 'total'},
                  {data: 'created_by', name: 'created_by'},
                  {data: 'created_at', name: 'created_at'},
                  {data: 'actions', name: 'actions'},
                  
               ],
        order: [[0, 'desc']],
        stateSave: true,
        bDestroy: true,
      });

      $('#search_name').on('keyup' , function(e){
          table.draw()
      })
      $('#search_date').on('change' , function(e){
          table.draw()
      })
})

  </script>
    

@endsection
