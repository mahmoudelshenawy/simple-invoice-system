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
							<h4 class="content-title mb-0 my-auto">الكتالوج</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة النفقات و الاستُمارات</span>
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
			msg: "تم أزالة الخدمة بنجاح",
			type: "success"
		})
	}
</script>
@endif
@if (session()->has('Update'))
<script>
  window.onload = function() {
		notif({
			msg: "تم تحديث الخدمة بنجاح",
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
									@can('اضافة فاتورة')
									<a href="expenses_investment/create" class="btn btn-sm btn-primary" style="color:white"><i
									class="fas fa-plus"></i>&nbsp; اضافة نفقه/استثمار</a>
							     	@endcan
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive ">
									<table class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center" id="example1">
										<thead>
											<tr>
												<th class="wd-lg-8p"><span>#</span></th>
												
												<th class="wd-lg-15p"><span>الصوره</span></th>
												<th class="wd-lg-10p"><span>الاسم</span></th>
                                                <th class="wd-lg-10p"><span>الحالة/النوع</span></th>
												<th class="wd-lg-15p"><span>رقم الخدمة</span></th>
												<th class="wd-lg-10p"><span>سعر البيع</span></th>
												<th class="wd-lg-15p"><span>TAX</span></th>
												<th class="wd-lg-25p">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@php
												$i=0;
											@endphp
											@foreach ($expinvs as $expinv)
											@php $i++; @endphp
											<tr>
												<td>
												{{$i}}
												</td>
												<td>
                                                    <img src="{{ url($expinv->imagePath) }}" alt="" width="40" height="30" class="img-fluid">
													<br>
												</td>
												<td>
													{{$expinv->name}}
												</td>
												<td>
													{{$expinv->type}}
												</td>
												<td>
													{{$expinv->reference_number}}
												</td>
												<td class="text-center">
													{{$expinv->sales_price}}
												</td>
												<td>
														{{$expinv->tax}}
												</td>
												<td>
													<a href="/catalog/expenses_investment/{{$expinv->id}}" class="btn btn-sm btn-primary">
														<i class="las la-search"></i>
													</a>
													<a href="/catalog/expenses_investment/{{$expinv->id}}/edit" class="btn btn-sm btn-info">
														<i class="las la-pen"></i>
													</a>
													<a  href="#deleteserviceModal" class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													data-id="{{ $expinv->id }}" data-exp_name="{{ $expinv->name }}"
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
                   <h5 class="modal-title">حذف الخدمة</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="/catalog/expenses_investment/destroy" method="post">
                   {{ method_field('delete') }}
                   {{ csrf_field() }}
                   <div class="modal-body">
                       <p>هل انت متاكد من عملية الحذف ؟</p><br>
                       <input type="hidden" name="id" id="exp_id" value="">
                       <input class="form-control" name="exp_name" id="exp_name_delete" type="text" readonly>
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
 <!--Internal  Notify js -->
 <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
 <!--Internal  Modal js -->
 <script src="{{ asset('assets/js/modal.js') }}"></script>

 <script>
	$('#deleteserviceModal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var name = button.data('exp_name')
		var modal = $(this)
		modal.find('.modal-body #exp_id').val(id);
		modal.find('.modal-body #exp_name_delete').val(name);
	})

</script>
@endsection