@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="d-flex">
                        <h4 class="content-title mb-0 my-auto"><a href="/suppliers">الموردين</a>
							</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمةالموردين</span>
                    </div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-sm-12 col-lg-5 col-xl-4">
						<div class="card custom-card">
							<div class="">
								<div class="main-content-app main-content-contacts pt-0">
									<div class="main-content-left main-content-left-contacts">
										<nav class="nav main-nav-line main-nav-line-chat  pl-3">
											<a class="nav-link active" data-toggle="tab" href="">All Contacts</a>
										</nav>
										<div class="main-contacts-list" id="mainContactList">
											
                                            @forelse ($groups as $letter=>$group)
                                            <div class="main-contact-label">
												{{$letter}}
											</div>
                                            @foreach ($group as $supplier)
                                            <div class="main-contact-item" data-supplier="{{$supplier}}">
												<div class="main-avatar online">
													{{$letter}}
												</div>
												<div class="main-contact-body">
													<h6>{{$supplier['legal_name']}}</h6>
                                                    <span class="phone">{{$supplier['phone_1']}}</span>
                                                    <span class="phone">{{$supplier['email']}}</span>
												</div>
												<a class="main-contact-star" href="">
													<i class="fe fe-star mr-1 text-warning"></i>
													<i class="fe fe-edit-2 mr-1"></i>
													<i class="fe fe-more-vertical"></i>
												</a>
											</div>
                                            @endforeach
                                           
                                            @empty
                                                
                                            @endforelse
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-7 col-xl-8">
						<div class="">
							<div class="main-content-body main-content-body-contacts card custom-card">
								{{-- block code --}}
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-2">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li><a href="#tab4" class="nav-link active" data-toggle="tab">بيانات عامة</a></li>
														<li><a href="#tab5" class="nav-link" data-toggle="tab">المبيعات</a></li>
														<li><a href="#tab7" class="nav-link" data-toggle="tab">الفواتير</a></li>
														<li><a href="#tab8" class="nav-link" data-toggle="tab">المرفقات و الصور</a></li>
													</ul>
												</div>
											</div>
											{{-- tabs content --}}
											<div class="panel-body tabs-menu-body main-content-body-right border d-none"  id="supplier-info">
												<div class="tab-content">
											   <!-- Tab one -->
											   <div class="tab-pane active" id="tab4">
{{-- tab one --}}
<div class="main-contact-info-header">
	<div class="main-contact-info-body">
	<div class="media-list pb-0">
		<div class="media">
			<div class="media-body">
				<div>
					<label>Company Name</label> <span class="tx-medium" id="name"></span>
				</div>
				<div>
					<label>Offecial Name</label> <span class="tx-medium" id="legal_name"></span>
				</div>
			</div>
		</div>
		<div class="media">
			<div class="media-body">
				<div>
					<label>Gmail Account</label> <span class="tx-medium" id="email"></span>
				</div>
				<div>
					<label>Contact Number</label> <span class="tx-medium" id="phone_1"></span>
				</div>
			</div>
		</div>
		<div class="media">
			<div class="media-body">
				<div>
					<label>Another Contact Number</label> <span class="tx-medium" id="phone_2"></span>
				</div>
				<div>
					<label>Tax Number</label> <span class="tx-medium" id="tin"></span>
				</div>
			</div>
		</div>
		<div class="media mb-0">
			<div class="media-body">
				<div>
					<label>Bank Account</label> <span class="tx-medium" id="bank_account"></span>
				</div>
				<div>
					<label>Bank Name</label> <span class="tx-medium" id="bank_name"></span>
				</div>
				<div>
					<label>Currency</label> <span class="tx-medium" id="currency"></span>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
{{-- tab one end --}}
											   </div>	
											   {{-- tab two --}}
											   <div class="tab-pane" id="tab5">
												<div class="table-responsive">
													<table class="table table-hover mb-0 text-md-nowrap">
														<thead>
															<tr>
																<th>الرقم الضريبى</th>
																<th>اسم الملف</th>
																<th>الحالة</th>
																<th>القيمة</th>
																<th>تعديل</th>
															</tr>
														</thead>
														<tbody id="sales_table">
														</tbody>
													</table>
												</div>				
											   </div>   
											   {{-- tab two end --}}
											   <div class="tab-pane" id="tab7">
												<div class="table-responsive">
													<table class="table table-hover mb-0 text-md-nowrap">
														<thead>
															<tr>
																<th>الرقم الضريبى</th>
																<th>اسم الملف</th>
																<th>الحالة</th>
																<th>القيمة</th>
																<th>تعديل</th>
															</tr>
														</thead>
														<tbody id="invoices_table">
														</tbody>
													</table>
												</div>		
											   </div>   
												</div> 
											</div>
										</div>
									</div>
								</div>					     
								{{-- end block --}}
								
							</div>
						</div>
					</div>
				</div>
				<!-- End Row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Contact js -->
<script src="{{URL::asset('assets/js/contact.js')}}"></script>

<script>
	$('.main-contact-item').on('click', function(e){
		$('.main-contact-item').removeClass('selected')
		
		$(this).addClass('selected')
		var supplier = $(this).data('supplier')
		$('#supplier-info').removeClass('d-none')
		$('#name').text(supplier.name)
		$('#legal_name').text(supplier.legal_name)
		$('#tin').text(supplier.tin)
		$('#phone_1').text(supplier.phone_1)
		$('#phone_2').text(supplier.phone_2)
		$('#email').text(supplier.email)
		$('#bank_account').text(supplier.bank_account)
		$('#bank_name').text(supplier.name)
		$('#currency').text(supplier.currency)
		var tr=''
		var tr_2=''
		supplier.purchase_invoices.forEach(function(sale){
           tr += `
		   <tr>
		   <td>${sale.reference_number}</td>
		   <td>${sale.title}</td>
		   <td>${sale.status}</td>
		   <td>${sale.total}</td>
		   <td>	<a href="/choose_items_of_sale/${sale.id}" class="btn btn-sm btn-info"><i class="las la-pen"></i>	</a></td>
		   </tr>
		   `
		})
		$('#sales_table').html(tr)
		supplier.purchase_orders.forEach(function(invoice){
           tr_2 += `
		   <tr>
		   <td>${invoice.reference_number}</td>
		   <td>${invoice.title}</td>
		   <td>${invoice.status}</td>
		   <td>${invoice.total}</td>
		   <td>	<a href="/choose_items_of_invoice/${invoice.id}" class="btn btn-sm btn-info"><i class="las la-pen"></i>	</a></td>
		</tr>
		   `
		})
		$('#invoices_table').html(tr_2)
		console.log(supplier)
	})
</script>
@endsection