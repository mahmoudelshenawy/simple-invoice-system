@extends('layouts.master')
@section('css')
<!-- Internal Gallery css -->
<link href="{{URL::asset('assets/plugins/gallery/gallery.css')}}" rel="stylesheet">
 <!--Internal   Notify -->
 <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Tasks</span>
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
@if (session()->has('Add'))
<script>
  window.onload = function() {
		notif({
			msg: "تم الاضافة بنجاح",
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
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-9 col-md-12">
						<div class="row row-sm">
							<!-- col -->
							<div class="col-lg-12">
								<div class="card mg-b-20">
									<div class="card-body d-flex p-3">
										<div class="main-content-label mb-0 mg-t-8">Employees / Users Tasks</div>
										<div class="mr-auto">
											<a href="#addNewTask"  data-toggle="modal" class="modal-effect d-block tx-20" data-placement="top" data-toggle="tooltip" data-effect="effect-scale" title="إضافة مهمة جديدة" href="#"><i class="si si-plus text-muted"></i></a>
										</div>
									</div>
								</div>
							</div>
							<!-- /col -->
@foreach ($tasks as $task)
<div class="col-xl-6 col-md-6">
	<div class="card mg-b-20">
		<div class="card-body p-0">
			<div class="d-flex justify-content-between">
				<div class="p-4">
					<a href="/tasks/{{$task->id}}/edit">
						<span class="tx-12 text-muted">{{$task->created_at->format('h:i A')}}</span>
					<span class="badge bg-primary-transparent text-primary mr-4">New task</span>
					<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{$task->subject}}</h5>
					</a>
				</div>
				<div class="align-self-center d-flex justify-content-center p-4 mt-3">
					<div class="custom-controls-stacked">
						<label class="ckbox mg-b-10"><input name="completed" type="checkbox" value="false"><span></span></label>
					</div>
					<div class="rating-star">
						<i class="fa fa-star {{$task->important == 1 ? 'text-warning' : 'text-secondary'}} " id="important" style="cursor: pointer"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
							{{-- <!-- col -->
							
							<!-- /col -->

							<!-- col -->
							<div class="col-xl-4 col-md-6">
								<div class="card mg-b-20">
									<div class="card-body p-0">
										<div class="todo-widget-header d-flex pb-2 pd-20">
											<div class="drop-down-profile" data-toggle="dropdown"><img alt="" class="rounded-circle avatar avatar-md " src="{{URL::asset('assets/img/faces/12.jpg')}}"><span class="assigned-task bg-info">2</span></div>
											<div class="dropdown-menu tx-13">
												<div class="main-header-profile">
													<div class="tx-16 h5 mg-b-0">Petey Cruiser</div>
													<span>Web Designer</span>
												</div>
												<a class="dropdown-item" href="#">View Total Tasks</a>
												<a class="dropdown-item" href="#">Completed Tasks</a>
												<a class="dropdown-item" href="#">Settings</a>
											</div>
											<div class="mr-auto">
												<div class="">
													<a href="#" data-placement="top" data-toggle="tooltip" title="archive" class="p-2 text-muted"><i class="fas fa-envelope-open-text"></i></a>
													<a  href="#" data-placement="top" data-toggle="tooltip" title="Move to spam" class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
													<a class="p-2 text-muted" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
													<div class="dropdown-menu tx-13">
														<a class="dropdown-item" href="#">Mark As Unread</a>
														<a class="dropdown-item" href="#">Mark As Important</a>
														<a class="dropdown-item" href="#">Add to Tasks</a>
														<a class="dropdown-item" href="#">Add Star</a>
														<a class="dropdown-item" href="#">Move to</a>
														<a class="dropdown-item" href="#">Mute</a>
														<a class="dropdown-item" href="#">Move to Trash</a>
													</div>
												</div>
											</div>
										</div>
										<div class="p-4">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-primary-transparent text-primary mr-auto float-left">New task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">voluptatem accusantium dolo laudantium</h5>
										</div>
										<div class="p-4 border-top">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-danger-transparent text-danger mr-auto float-left">Pending task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">inventore veritatis et quasi architecto</h5>
										</div>
									</div>
									<div class="card-footer ">
										<a class="btn btn-primary" href="#" data-placement="top" data-toggle="tooltip" title="Assign Task">Assign</a>
										<a class="btn btn-outline-primary mr-auto float-left" href="#" data-placement="top" data-toggle="tooltip" title="View Task">View All</a>
									</div>
								</div>
							</div>
							<!-- /col -->

							<!-- col -->
							<div class="col-xl-4 col-md-6">
								<div class="card mg-b-20">
									<div class="card-body p-0">
										<div class="todo-widget-header d-flex pb-2 pd-20">
											<div class="drop-down-profile" data-toggle="dropdown"><img alt="" class="rounded-circle avatar avatar-md " src="{{URL::asset('assets/img/faces/9.jpg')}}"><span class="assigned-task bg-danger">6</span></div>
											<div class="dropdown-menu tx-13">
												<div class="main-header-profile">
													<div class="tx-16 h5 mg-b-0">Petey Cruiser</div>
													<span>Web Designer</span>
												</div>
												<a class="dropdown-item" href="#">View Total Tasks</a>
												<a class="dropdown-item" href="#">Completed Tasks</a>
												<a class="dropdown-item" href="#">Settings</a>
											</div>
											<div class="mr-auto">
												<div class="">
													<a href="#" data-placement="top" data-toggle="tooltip" title="archive" class="p-2 text-muted"><i class="fas fa-envelope-open-text"></i></a>
													<a  href="#" data-placement="top" data-toggle="tooltip" title="Move to spam" class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
													<a class="p-2 text-muted" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
													<div class="dropdown-menu tx-13">
														<a class="dropdown-item" href="#">Mark As Unread</a>
														<a class="dropdown-item" href="#">Mark As Important</a>
														<a class="dropdown-item" href="#">Add to Tasks</a>
														<a class="dropdown-item" href="#">Add Star</a>
														<a class="dropdown-item" href="#">Move to</a>
														<a class="dropdown-item" href="#">Mute</a>
														<a class="dropdown-item" href="#">Move to Trash</a>
													</div>
												</div>
											</div>
										</div>
										<div class="p-4">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-primary-transparent text-primary mr-auto float-left">New task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">Nemo enim ipsam voluptatem quia voluptas</h5>
										</div>
										<div class="p-4 border-top">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-danger-transparent text-danger mr-auto float-left">Pending task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">vero eos et accusamus et iusto odio dignissimos</h5>
										</div>
									</div>
									<div class="card-footer ">
										<a class="btn btn-primary" href="#" data-placement="top" data-toggle="tooltip" title="Assign Task">Assign</a>
										<a class="btn btn-outline-primary mr-auto float-left" href="#" data-placement="top" data-toggle="tooltip" title="View Task">View All</a>
									</div>
								</div>
							</div>
							<!-- /col -->

							<!-- col -->
							<div class="col-xl-4 col-md-6">
								<div class="card mg-b-20 mg-lg-b-0">
									<div class="card-body p-0">
										<div class="todo-widget-header d-flex pb-2 pd-20">
											<div class="drop-down-profile" data-toggle="dropdown"><img alt="" class="rounded-circle avatar avatar-md " src="{{URL::asset('assets/img/faces/4.jpg')}}"><span class="assigned-task bg-info">9</span></div>
											<div class="dropdown-menu tx-13">
												<div class="main-header-profile">
													<div class="tx-16 h5 mg-b-0">Petey Cruiser</div>
													<span>Web Designer</span>
												</div>
												<a class="dropdown-item" href="#">View Total Tasks</a>
												<a class="dropdown-item" href="#">Completed Tasks</a>
												<a class="dropdown-item" href="#">Settings</a>
											</div>
											<div class="mr-auto">
												<div class="">
													<a href="#" data-placement="top" data-toggle="tooltip" title="archive" class="p-2 text-muted"><i class="fas fa-envelope-open-text"></i></a>
													<a  href="#" data-placement="top" data-toggle="tooltip" title="Move to spam" class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
													<a class="p-2 text-muted" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
													<div class="dropdown-menu tx-13">
														<a class="dropdown-item" href="#">Mark As Unread</a>
														<a class="dropdown-item" href="#">Mark As Important</a>
														<a class="dropdown-item" href="#">Add to Tasks</a>
														<a class="dropdown-item" href="#">Add Star</a>
														<a class="dropdown-item" href="#">Move to</a>
														<a class="dropdown-item" href="#">Mute</a>
														<a class="dropdown-item" href="#">Move to Trash</a>
													</div>
												</div>
											</div>
										</div>
										<div class="p-4">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-primary-transparent text-primary mr-auto float-left">New task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">Ut enim ad minima veniam nostrum exercitationem</h5>
										</div>
										<div class="p-4 border-top">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-danger-transparent text-danger mr-auto float-left">Pending task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">Quis autem vel eum iure reprehenderit qui</h5>
										</div>
									</div>
									<div class="card-footer ">
										<a class="btn btn-primary disabled" href="#" data-placement="top" data-toggle="tooltip" title="Assign Task">Assign</a>
										<a class="btn btn-outline-primary mr-auto float-left" href="#" data-placement="top" data-toggle="tooltip" title="View Task">View All</a>
									</div>
								</div>
							</div>
							<!-- /col -->

							<!-- col -->
							<div class="col-xl-4  col-md-6">
								<div class="card mg-b-20 mg-lg-b-0">
									<div class="card-body p-0">
										<div class="todo-widget-header d-flex pb-2 pd-20">
											<div class=" drop-down-profile" data-toggle="dropdown"><img alt="" class="rounded-circle avatar avatar-md" src="{{URL::asset('assets/img/faces/15.jpg')}}"><span class="assigned-task bg-primary">7</span></div>
											<div class="dropdown-menu tx-13">
												<div class="main-header-profile">
													<div class="tx-16 h5 mg-b-0">Petey Cruiser</div>
													<span>Web Designer</span>
												</div>
												<a class="dropdown-item" href="#">View Total Tasks</a>
												<a class="dropdown-item" href="#">Completed Tasks</a>
												<a class="dropdown-item" href="#">Settings</a>
											</div>
											<div class="mr-auto">
												<div class="">
													<a href="#" data-placement="top" data-toggle="tooltip" title="archive" class="p-2 text-muted"><i class="fas fa-envelope-open-text"></i></a>
													<a  href="#" data-placement="top" data-toggle="tooltip" title="Move to spam" class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
													<a class="p-2 text-muted" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
													<div class="dropdown-menu tx-13">
														<a class="dropdown-item" href="#">Mark As Unread</a>
														<a class="dropdown-item" href="#">Mark As Important</a>
														<a class="dropdown-item" href="#">Add to Tasks</a>
														<a class="dropdown-item" href="#">Add Star</a>
														<a class="dropdown-item" href="#">Move to</a>
														<a class="dropdown-item" href="#">Mute</a>
														<a class="dropdown-item" href="#">Move to Trash</a>
													</div>
												</div>
											</div>
										</div>
										<div class="p-4">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-primary-transparent text-primary mr-auto float-left">New task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">I must explain to you how all this mistaken</h5>
										</div>
										<div class="p-4 border-top">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-danger-transparent text-danger mr-auto float-left">Pending task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">I will give you a complete account of the system</h5>
										</div>
									</div>
									<div class="card-footer ">
										<a class="btn btn-primary" href="#" data-placement="top" data-toggle="tooltip" title="Assign Task">Assign</a>
										<a class="btn btn-outline-primary mr-auto float-left" href="#" data-placement="top" data-toggle="tooltip" title="View Task">View All</a>
									</div>
								</div>
							</div>
							<!-- /col -->

							<!-- col -->
							<div class="col-xl-4 col-md-6">
								<div class="card mg-b-20 ">
									<div class="card-body p-0">
										<div class="todo-widget-header d-flex pb-2 pd-20">
											<div class="drop-down-profile" data-toggle="dropdown"><img alt="" class="rounded-circle avatar avatar-md " src="{{URL::asset('assets/img/faces/5.jpg')}}"><span class="assigned-task bg-info">4</span></div>
											<div class="dropdown-menu tx-13">
												<div class="main-header-profile">
													<div class="tx-16 h5 mg-b-0">Petey Cruiser</div>
													<span>Web Designer</span>
												</div>
												<a class="dropdown-item" href="#">View Total Tasks</a>
												<a class="dropdown-item" href="#">Completed Tasks</a>
												<a class="dropdown-item" href="#">Settings</a>
											</div>
											<div class="mr-auto">
												<div class="">
													<a href="#" data-placement="top" data-toggle="tooltip" title="archive" class="p-2 text-muted"><i class="fas fa-envelope-open-text"></i></a>
													<a  href="#" data-placement="top" data-toggle="tooltip" title="Move to spam" class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
													<a class="p-2 text-muted" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
													<div class="dropdown-menu tx-13">
														<a class="dropdown-item" href="#">Mark As Unread</a>
														<a class="dropdown-item" href="#">Mark As Important</a>
														<a class="dropdown-item" href="#">Add to Tasks</a>
														<a class="dropdown-item" href="#">Add Star</a>
														<a class="dropdown-item" href="#">Move to</a>
														<a class="dropdown-item" href="#">Mute</a>
														<a class="dropdown-item" href="#">Move to Trash</a>
													</div>
												</div>
											</div>
										</div>
										<div class="p-4">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-primary-transparent text-primary mr-auto float-left">New task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">Rationally encounter quences extremely painful</h5>
										</div>
										<div class="p-4 border-top">
											<span class="tx-12 text-muted">10.54am</span><span class="badge bg-danger-transparent text-danger mr-auto float-left">Pending task</span>
											<h5 class="tx-14 mb-0 mg-t-5 text-capitalize">Which of us ever undertakes laborious physical</h5>
										</div>
									</div>
									<div class="card-footer ">
										<a class="btn btn-primary" href="#" data-placement="top" data-toggle="tooltip" title="Assign Task">Assign</a>
										<a class="btn btn-outline-primary mr-auto float-left" href="#" data-placement="top" data-toggle="tooltip" title="View Task">View All</a>
									</div>
								</div>
							</div>
							<!-- /col -->
						</div>
					</div>
					<!-- /col --> --}}

					{{-- <!-- col -->
					<div class="col-lg-12 col-xl-3">
						<div class="card card--events mg-b-20">
							<div class="card-body">
								<div class="pd-20">
									<div class="main-content-label">Tasks</div>
									<p class="mg-b-0">It is Very Easy to Customize and it uses in website apllication.</p>
								</div>
								<div class="list-group to-do-tasks">
									<a class="list-group-item" href="#">
										<div class="event-indicator bg-info"></div>
										<h6 class="mg-t-5">Today Tasks</h6>
									</a>
									<a class="list-group-item" href="#">
										<div class="event-indicator bg-primary"></div>
										<h6 class="mg-t-5">Yesterday Tasks</h6>
									</a>
									<a class="list-group-item" href="#">
										<div class="event-indicator bg-success"></div>
										<h6 class="mg-t-5">Weakly Tasks</h6>
									</a>
									<a class="list-group-item" href="#">
										<div class="event-indicator bg-danger"></div>
										<h6 class="mg-t-5">Mothly Tasks</h6>
									</a>
									<a class="list-group-item" href="#">
										<div class="event-indicator bg-warning"></div>
										<h6 class="mg-t-5">User Tasks</h6>
									</a>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body p-0">
								<div class="pd-t-20 pd-l-20 pd-r-20">
									<div class="main-content-label">Recent Tasks</div>
									<p class="mg-b-20">It is Very Easy to Customize and it uses in website apllication.</p>
								</div>
								<div class="d-flex p-3 border-top">
									<label class="ckbox"><input checked="" type="checkbox"><span>Do something more</span></label>
									<span class="mr-auto">
										<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
										<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
									</span>
								</div>
								<div class="d-flex p-3 border-top">
									<label class="ckbox"><input checked="" type="checkbox"><span>Update More Files</span></label>
									<span class="mr-auto">
										<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
										<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
									</span>
								</div>
								<div class="d-flex p-3 border-top">
									<label class="ckbox"><input type="checkbox"><span>Complete Projects</span></label>
									<span class="mr-auto">
										<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
										<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
									</span>
								</div>
								<div class="d-flex p-3 border-top">
									<label class="ckbox"><input type="checkbox"><span>Finish Something</span></label>
									<span class="mr-auto">
										<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
										<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
									</span>
								</div>
								<div class="d-flex p-3 border-top">
									<label class="ckbox"><input checked="" type="checkbox"><span>System Updated</span></label>
									<span class="mr-auto">
										<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
										<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
									</span>
								</div>
								<div class="d-flex p-3 border-top">
									<label class="ckbox"><input type="checkbox"><span>Change Settings</span></label>
									<span class="mr-auto">
										<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
										<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
									</span>
								</div>
							</div>
						</div>
					</div> --}}
				</div>
				<!-- row closed -->

		<!-- add task -->
		<div class="modal fade" id="addNewTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">عنوان المهمة</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{ route('tasks.store') }}" method="post">
					@csrf
					<div class="modal-body">
						<div class="form-group">
							<label for="subject">العنوان</label>
							<input type="text" class="form-control" id="subject" name="subject" placeholder="عنوان المهمة" required>
							@error('subject')
							<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
						<button type="submit" class="btn btn-success">تاكيد</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
		{{--end add task  --}}
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
 <!--Internal  Modal js -->
 <script src="{{ asset('assets/js/modal.js') }}"></script>
  <!--Internal  Notify js -->
  <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
     <!-- Internal form-elements js -->
	 <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
	 <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

	 <script>
		 $('#important').on('click', function(e){
			 $('#important').toggleClass('text-warning')
		 })
	 </script>
@endsection