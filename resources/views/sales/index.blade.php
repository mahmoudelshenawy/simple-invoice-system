@extends('layouts.master')
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
							<h4 class="content-title mb-0 my-auto">المبيعات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المبيعات</span>
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
			msg: "تم أزالة البيانات بنجاح",
			type: "success"
		})
	}
</script>
@endif
@if (count($errors->all()) > 0)
<script>
  window.onload = function() {
		notif({
			msg: "من فضلك قم بمراجعة البيانات",
			type: "error"
		})
	}
</script>
@endif
@if (session()->has('Update'))
<script>
  window.onload = function() {
		notif({
			msg: "تم تحديث البيانات بنجاح",
			type: "success"
		})
	}
</script>
@endif
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card">
							<div class="card-header pb-0">
								<!--Add Btn-->
								<div class="d-flex justify-content-between">
									@can('control_sales')
									<a href="#selectClient" class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale" data-toggle="modal" style="color:white"><i
									class="fas fa-plus"></i>&nbsp; اضافة بيع جديد</a>
							     	@endcan
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive ">
									<table class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center" id="example1">
										<thead>
											<tr>
												<th class="wd-lg-8p"><span>#</span></th>
                                                <th class="wd-lg-10p"><span>رقم الفاتورة</span></th>
												<th class="wd-lg-15p"><span>العنوان</span></th>
												<th class="wd-lg-10p"><span>اسم العميل</span></th>
												<th class="wd-lg-10p"><span>الحالة</span></th>
												<th class="wd-lg-15p"><span>تاريخ الفاتورة</span></th>
												<th class="wd-lg-25p">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@php
												$i=0;
											@endphp
											@foreach ($sales as $sale)
											@php $i++; @endphp
											<tr>
												<td>
												{{$i}}
												</td>
												<td>
													{{$sale->reference_number ?? 'Unspicified'}}
												</td>
												<td>
													{{$sale->title ?? 'Unspicified'}}
												</td>
												<td>
													{{$sale->client->name}}
												</td>
												<td>
													<span class="{{status_color($sale->status)}} text-white p-2">
														{{$sale->status}}
													</span>
												</td>
												<td>
													{{$sale->created_at->format('m/d/Y')}}
													<br>
													{{$sale->created_at->format('h:i:s A')}}
												</td>
												<td>
													<a href="/sales_data/{{$sale->id}}" class="btn btn-sm btn-primary">
														<i class="las la-search"></i>
													</a>
													<a href="/sales_data/{{$sale->id}}" class="btn btn-sm btn-info">
														<i class="las la-pen"></i>
													</a>
													<a  href="#deleteserviceModal" class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													data-id="{{ $sale->id }}" data-sale_name="{{ $sale->name }}"
													data-toggle="modal"title="حذف"><i
														class="las la-trash"></i></a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div><!-- COL END -->
				</div>
				<!-- row closed  -->
				 <!-- row closed -->
    
       <!-- delete -->
       <div class="modal fade" id="deleteserviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">حذف بيانات البيع</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="/sales/test" method="post">
                   {{ method_field('delete') }}
                   {{ csrf_field() }}
                   <div class="modal-body">
                       <p>هل انت متاكد من عملية الحذف ؟</p><br>
                       <input type="hidden" name="id" id="sale_id" value="">
                       <input class="form-control" name="sale_name" id="sale_name_delete" type="text" readonly>
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

       <!-- select a client -->
       <div class="modal fade" id="selectClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">حذف الخدمة</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="{{ route('sales.store') }}" method="post">
                   @csrf
                   <div class="modal-body">
                       <p>من فضلك قم بإختيار العميل</p><br>

					   <select class="form-control select2-show-search select2-dropdown" name="client_id">
						   <option value="">من فضلك قم بإختيار العميل</option>
						@foreach ($clients as $client)
						   <option value="{{$client->id}}">{{$client->legal_name}}
						- <span>{{$client->name}}</span>
						</option>
						@endforeach
					   </select>   
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                       <button type="submit" class="btn btn-danger">تاكيد</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   {{-- end select client --}}
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
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
  <!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
 <!--Internal  Notify js -->
 <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
 <!--Internal  Modal js -->
 <script src="{{ asset('assets/js/modal.js') }}"></script>


 <script>
	$('#deleteserviceModal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var name = button.data('sale_name')
		var modal = $(this)
		modal.find('.modal-body #sale_id').val(id);
		modal.find('.modal-body #sale_name_delete').val(name);
	})

</script>
@endsection