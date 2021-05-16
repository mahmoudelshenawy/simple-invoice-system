@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<!-- breadcrumb -->
@endsection
@section('content')
    <div id="app">
    <chat-page :contacts="{{$admins}}"
	            :user="{{ Auth::user() }}"
	></chat-page>
   </div>
				
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script src="{{ asset('js/app.js') }}"></script>
<!--Internal  lightslider js -->
<script src="{{URL::asset('assets/plugins/lightslider/js/lightslider.min.js')}}"></script>
<!--Internal  Chat js -->
<script src="{{URL::asset('assets/js/chat.js')}}"></script>
@endsection