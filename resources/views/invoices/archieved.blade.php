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
							<h4 class="content-title mb-0 my-auto">الفواتير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير </span>
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
			msg: "تم أزالة الفاتوره بنجاح",
			type: "success"
		})
	}
</script>
@endif
@if (count($errors->all()) > 0)
<script>
  window.onload = function() {
		notif({
			msg: "من فضلك قم بمراجعة الفاتوره",
			type: "error"
		})
	}
</script>
@endif
@if (session()->has('Archieve'))
<script>
  window.onload = function() {
		notif({
			msg: "تم أرشفة الفاتوره بنجاح",
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
							</div>
							<div class="card-body">
								<div class="table-responsive ">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
										<thead>
											<tr>
												<th class="wd-lg-5p"><span>#</span></th>
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
											@foreach ($invoices as $invoice)
											@php $i++; @endphp
											<tr>
												<td>
												{{$i}}
												</td>
												<td>
													{{$invoice->reference_number ?? 'Unspicified'}}
												</td>
												<td>
													{{$invoice->title ?? 'Unspicified'}}
												</td>
												<td>
													{{$invoice->client->name}}
												</td>
												<td class="text-center">
													@if ($invoice->status == 'Unpaid')
													<span class="text-white btn btn-warning">
														{{$invoice->status}}
													</span>
													@else
													<span class="text-white btn btn-success">
														{{$invoice->status}}
													</span>
													@endif
												</td>
												<td>
													
													{{$invoice->created_at->toDateString()}}
												</td>
												<td>
														<div class="dropdown">
                                               
															<button aria-expanded="false" aria-haspopup="true"
																class="btn ripple btn-primary" data-toggle="dropdown"
																type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
																<div class="dropdown-menu tx-13">
																	
																	@can('control_invoices')
																		<a class="dropdown-item modal-effect" href="#" 
																			data-effect="effect-scale"
																			data-id="{{ $invoice->id }}" data-invoice_name="{{ $invoice->title }}"
																			data-toggle="modal" data-target="#deleteserviceModal"><i
																				class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
																			الفاتورة</a>
																	@endcan
																	@can('control_invoices')
																		<a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
																			data-toggle="modal" data-target="#Restore_invoice"><i
																				class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
																			الفواتير</a>
																	@endcan
																</div>
														</div>
														
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
                   <h5 class="modal-title">حذف بيانات الفاتورة</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                  @csrf
                  @method('DELETE')
                   <div class="modal-body">
                       <p>هل انت متاكد من عملية حزف الفاتورة ؟</p><br>
                       <input type="hidden" name="invoice_id" id="invoice_id" value="">
                       <input type="hidden" name="id_page" id="id_page" value="delete">
                       <input class="form-control" name="invoice_name" id="invoice_name_delete" type="text" readonly>
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
       <!-- restore -->
       <div class="modal fade" id="Restore_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">استعادة بيانات الفاتورة</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="{{ url('/restore_invoice') }}" method="post">
                  @csrf
                   <div class="modal-body">
                       <p>هل انت متاكد من عملية استعادة الفاتورة ؟</p><br>
                       <input type="hidden" name="id" id="invoice_id" value="">
                       <input class="form-control" name="invoice_name" id="invoice_name_delete" type="text" readonly>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                       <button type="submit" class="btn btn-danger">تاكيد</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   {{-- restore --}}

      

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
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script>
    $('#deleteserviceModal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var name = button.data('invoice_name')
		var modal = $(this)
		modal.find('.modal-body #invoice_id').val(id);
		modal.find('.modal-body #invoice_name_delete').val(name);
	})
	$('#Restore_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
</script>
@endsection