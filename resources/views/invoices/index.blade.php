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
			msg: "تم أزالة البيانات بنجاح",
			type: "success"
		})
	}
</script>
@endif
@if (session()->has('Restore'))
<script>
  window.onload = function() {
		notif({
			msg: "تم استعادة الفاتورة بنجاح",
			type: "success"
		})
	}
</script>
@endif
@if (count($errors->all()) > 0)
<script>
  window.onload = function() {
		notif({
			msg: "من فضلك قم بمراجعة الفاتورة",
			type: "error"
		})
	}
</script>
@endif
@if (session()->has('Update'))
<script>
  window.onload = function() {
		notif({
			msg: "تم تحديث الفاتورة بنجاح",
			type: "success"
		})
	}
</script>
@endif
@if (session()->has('Change_Status'))
<script>
  window.onload = function() {
		notif({
			msg: "تم تحديث حالة الفاتورة بنجاح",
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
								<div class="d-flex justify-content-start">
									@can('control_invoices')
									<a href="#selectClient" class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale" data-toggle="modal" style="color:white"><i
									class="fas fa-plus"></i>&nbsp; اضافة فاتورة جديد</a>
							     	@endcan
									 @can('control_invoices')
									 <a class="btn btn-sm btn-primary mr-4" href="{{ url('/invoices/export/') }}"
										 style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
								 @endcan
								</div>
								{{-- filter --}}
								<div class="row my-2" id="filter">
									<div class="col">
											<label for="inputName" class="control-label">بحث بالإسم</label>
											<input type="text" class="form-control" id="search_by_name" name="search_by_name" value="{{old('search_by_name')}}" placeholder="ابحث بواسطه اسم العميل او رقم الفاتورة">
									</div>
									<div class="col">
										<label>تاريخ إصدار الفاتورة</label>
										<input class="form-control fc-datepicker" name="search_by_date" placeholder="YYYY-MM-DD"
											type="text" value="{{ date('Y-m-d') }}" id="search_by_date">
									</div>
									<div class="col">
										<label>تاريخ التحصيل الفاتورة</label>
										<input class="form-control fc-datepicker" name="search_by_due_date" placeholder="YYYY-MM-DD"
											type="text" value="{{ date('Y-m-d') }}" id="search_by_due_date">
									</div>
								</div>
								{{-- buttons --}}
							
							</div>
							<div class="card-body">
								<div class="table-responsive ">
									<table id="syetem-table" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
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
													<br>
												<span class="text-muted">{{$invoice->title ?? 'Unspicified'}}</span>	
												</td>
												<td>
													{{$invoice->client->name}}
													<ul class="text-muted">
														<li>
															{{$invoice->client->address ?? 'NO Contacts'}}
														</li>
														<li>
															{{$invoice->client->phone_1 ?? 'NO Contacts'}}
														</li>
														<li>
															{{$invoice->client->email ?? 'NO Contacts'}}
														</li>
													</ul>
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
													{{$invoice->total}} $
												</td>
												<td>
													{{$invoice->admin->name ?? ''}}
												</td>
												<td>
													{{$invoice->created_at->format('m/d/Y')}}
													<br>
													{{$invoice->created_at->format('h:i:s A')}}
												</td>
												<td>
														<div class="dropdown">
                                               
															<button aria-expanded="false" aria-haspopup="true"
																class="btn ripple btn-primary" data-toggle="dropdown"
																type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
																<div class="dropdown-menu tx-13">
																	@can('control_invoices')
																		<a class="dropdown-item"
																			href="/invoice_data/{{$invoice->id}}">تعديل
																			الفاتورة</a>
																	@endcan
				
																	@can('control_invoices')
																		<a class="dropdown-item modal-effect" href="#" data-invoice_id="{{ $invoice->id }}"
																			data-effect="effect-scale"
																			data-id="{{ $invoice->id }}" data-invoice_name="{{ $invoice->title }}"
																			data-toggle="modal" data-target="#deleteserviceModal"><i
																				class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
																			الفاتورة</a>
																	@endcan
				
																	@can('control_invoices')
																		<a class="dropdown-item"
																			href="invoices/change_payment_status/{{$invoice->id}}">
																			<i class="text-success fas fa-money-bill"></i>&nbsp;&nbsp;
																			تغير
																			حالة
																			الدفع
																		</a>
																	@endcan
				
																	@can('archieve_invoices')
																		<a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
																			data-toggle="modal" data-target="#Transfer_invoice"><i
																				class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
																			الارشيف</a>
																	@endcan
				
																	@can('control_invoices')
																		<a class="dropdown-item" href="print_invoice/{{ $invoice->id }}"><i
																				class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
																			الفاتورة
																		</a>
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
               <form action="/invoices/test" method="post">
                   {{ method_field('delete') }}
                   {{ csrf_field() }}
                   <div class="modal-body">
                       <p>هل انت متاكد من عملية الحذف ؟</p><br>
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
  <!-- ارشيف الفاتورة -->
  <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
			  <form action="{{ route('invoices.destroy', 'test') }}" method="post">
				  {{ method_field('delete') }}
				  {{ csrf_field() }}
		  </div>
		  <div class="modal-body">
			  هل انت متاكد من عملية الارشفة ؟
			  <input type="hidden" name="invoice_id" id="invoice_id_transfer" value="">

		  </div>
		  <div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
			  <button type="submit" class="btn btn-success">تاكيد</button>
		  </div>
		  </form>
	  </div>
  </div>
</div>
       <!-- select a client -->
       <div class="modal fade" id="selectClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">اختيار عميل</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="{{ route('invoices.store') }}" method="post">
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
                       <button type="submit" class="btn btn-success">تاكيد</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   {{-- end select client --}}
<!-- delete -->
<div class="modal fade" id="changeInvoiceStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">تغيير بيانات الفاتورة</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="/invoices/test" method="post">
			{{ csrf_field() }}
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<label> الحالة</label>
						<select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
							<option value="Unpaid">Unpaid</option>
							<option value="Paid">Paid</option>
							<option value="Partially_Paid">Partially Paid</option>
						</select>
							@error('status')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					{{-- 2 --}}
					<div class="col">
						<label for="inputName" class="control-label">قيمة المبلغ المدفوع</label>
						<input type="number" class="form-control @error('reference_number') is-invalid @enderror" id="inputName" name="reference_number" value="">
							@error('reference_number')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					{{-- 3 --}}
					<div class="col">
						<label for="inputName" class="control-label">تاريخ الدفع</label>
						<input class="form-control" id="dateMask" placeholder="MM/DD/YYYY" type="text">
							@error('reference_number')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
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
     //datatable base
	var table = $('#syetem-table').DataTable({
		lengthChange: false,
		"sDom": "rtipl",
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
    // filter by name
	   $("#search_by_name").on('keyup' , function(e){
	         var text = e.target.value;
	            $.ajax({
                        url: "/invoices",
                        type: "GET",
						data:{
							text : text
						},
                        dataType: "json",
                        success: function(data) {    
                        console.log(data)
						table.ajax.reload();
                        },
                });
	})	

	// End filter
	   var date = $('.fc-datepicker').datepicker({
              dateFormat: 'yy-mm-dd',
          }).val();
	$('#deleteserviceModal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var name = button.data('invoice_name')
		var modal = $(this)
		modal.find('.modal-body #invoice_id').val(id);
		modal.find('.modal-body #invoice_name_delete').val(name);
	})
	$('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id_transfer').val(invoice_id);
        })	
</script>
@endsection