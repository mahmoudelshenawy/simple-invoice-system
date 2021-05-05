@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit-Profile</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                <form class="form-horizontal" action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
				<div class="row row-sm">
					<!-- Col -->
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{URL::asset('Images/default.jpg')}}" id="imagePreview">
                                            <span class="" style="cursor: pointer;">
                                                <a class="fas fa-camera profile-edit" href="JavaScript:void(0);position:relative" style="cursor: pointer;">
                                                    <input type="file" name="image" id="imgInp" style="opacity: 0; position:absolute;top:0;right:0;z-index:999;cursor:pointer !important">
                                                </a>
                                            </span>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{$user->name}}</h5>
												<h5 class="main-profile-name">Administrator</h5>
												<p class="main-profile-name-text">{{$user->email}}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 col mb20">
												<h5>947</h5>
												<h6 class="text-small text-muted mb-0">admins</h6>
											</div>
											<div class="col-md-4 col mb20">
												<h5>583</h5>
												<h6 class="text-small text-muted mb-0">Invoices</h6>
											</div>
											<div class="col-md-4 col mb20">
												<h5>48</h5>
												<h6 class="text-small text-muted mb-0">Profits</h6>
											</div>
										</div>
										
			
									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
					</div>

					<!-- Col -->
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="mb-4 main-content-label">Personal Information</div>
								
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Language</label>
											</div>
											<div class="col-md-9">
												<select class="form-control select2" name="language">
													<option value="english">Us English</option>
													<option value="arabic">Arabic</option>
												</select>
											</div>
										</div>
									</div>
									<div class="mb-4"></div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">User Name</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="User Name" value="{{$user->name}}">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">First Name</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="First Name" name="first_name" value="">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">last Name</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="Last Name" name="last_name" value="">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">TIN</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="9 digits" name="tin" value="">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">phon 1</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="phon 1" name="phone_1" value="">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">phon 2</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="phon 2" name="phone_2" value="">
											</div>
										</div>
									</div>
									<div class="mb-4"></div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Email</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control" name="email"  placeholder="Email" value="{{$user->email}}">
											</div>
										</div>
									</div>
								
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Address</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="addess" name="address" value="">
											</div>
										</div>
									</div>
									
									
								
									
									<div class="mb-4 main-content-label">About Yourself</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Biographical Info</label>
											</div>
											<div class="col-md-9">
												<textarea class="form-control" name="bio example-textarea-input" rows="4" placeholder="add you bio"></textarea>
											</div>
										</div>
									</div>
									<div class="mb-4 main-content-label">Email Preferences</div>
									<div class="form-group mb-0">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">Verified User</label>
											</div>
											<div class="col-md-9">
												<div class="custom-controls-stacked">
													<label class="ckbox mg-b-10"><input checked="" type="checkbox"><span> Accept to receive post or page notification emails</span></label>
													<label class="ckbox"><input checked="" type="checkbox"><span> Accept to receive email sent to multiple recipients</span></label>
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="col-md-9 col-offset-3">
                                                <a class="modal-effect btn btn-primary btn-primary-gradient waves-effect my-4" data-effect="effect-scale" data-toggle="modal" href="#changePassword">Change Password</a>
											</div>
                                        </div>
									</div>
								
							</div>
							<div class="card-footer text-left">
								<button type="submit" class="btn btn-primary waves-effect waves-light">Update Profile</button>
							</div>
						</div>
					</div>
					<!-- /Col -->
              
				</div>
            </form>
				<!-- row closed -->
                	<!-- Modal effects -->
		<div class="modal" id="changePassword">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Change Password</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">old password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control"  placeholder="old password" name="old_password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">New Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="new_password"  placeholder="new password" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Repeat Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="password confirmation" value="">
                            </div>
                        </div>
					
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary" type="button">save</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal effects-->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#imagePreview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>
@endsection