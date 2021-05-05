@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half  "ht-xl-80p wd-md-100p wd-xl-80p" -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto" class="login-side-panner">
							{{-- <img src="{{URL::asset('assets/img/backgrounds/bg.jpg')}}" class="img-fluid" alt="logo" style="height: 100vh;object-fit:contain;width:100%"> --}}
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex flex-row">
                                             <a href="{{ url('/' . $page='index') }}">
                                                <img src="{{URL::asset('assets/img/brand/mg.png')}}" class="sign-favicon ht-200" alt="logo">
                                            </a>
                                        </div>
                                        <div class="card-title" style="margin-top: -40px;">
                                            <h6 class="font-weight-semibold tx-28">
                                                Icandra 
                                            </h6>
                                        </div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
												<form method="POST" action="{{ route('login') }}">
                                                    @csrf
													<div class="form-group">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
													</div>
													<div class="form-group">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
													</div>
                                                    <button class="btn btn-main-primary btn-block">Sign In</button>
                                                    
												</form>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->

				
			</div>
		</div>
@endsection
@section('js')
@endsection