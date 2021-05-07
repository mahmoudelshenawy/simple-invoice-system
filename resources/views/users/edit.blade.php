@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
 <!--- Internal Select2 css-->
 <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
  <!--Internal   Notify -->
  <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@section('title')
تعديل بيانات مستخدم - مورا سوفت للادارة القانونية
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">
             <a href="/users">المستخدمين</a>   
            </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل بيانات
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@if (count($errors) > 0)
<script>
window.onload = function() {
    notif({
        msg: "الرجاء مراجعة البيانات",
        type: "error"
    })
}
</script>
@endif
@if (session()->has('Add'))
<script>
window.onload = function() {
    notif({
        msg: "تم تعديل بيانات المستخدم بنجاح",
        type: "success"
    })
}
</script>
@endif
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                    </div>
                </div><br>
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('users.update', $user->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="name" value="{{$user->name}}" type="text">
                                    @error('name')
                                <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="email" value="{{$user->email}}" type="email">
                                    @error('email')
                            <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="password" required="" type="password">
                                @error('password')
                            <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="password_confirmation" required="" type="password">
                                @error('password_confirmation')
                            <span class="text-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-sm mg-b-20">
                        <div class="col-lg-6">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="status" id="select-beast" class="form-control nice-select custom-select">
                               <option value="active" {{$user->status == 'active' ? 'selected' : ''}}>Active</option>
                               <option value="inactive" {{$user->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center">
                            <label class="ckbox mt-2"><input type="checkbox" name="super_admin" @role('Administrator') checked @else  @endrole id="super_admin_check"><span>Set as Administrator</span></label>
                        </div> 
                    </div>

                    <div class="row mg-b-20">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label"> صلاحية المستخدم</label>
                                <select name="role_id[]" id="roles" multiple="multiple" class="form-control @error('roles') is-invalid @enderror select2" >
                                    <option value="">Select a Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>   
                                @error('role_id')
                                <span class="text-danger" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
 <!-- Internal Select2 js-->
 <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
 <!--Internal  Form-elements js-->
 <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
 <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>

    if($('#super_admin_check').is(':checked')){
            $('#roles').attr('disabled', true)
        }else{
            $('#roles').removeAttr('disabled')
        }


    $('#super_admin_check').on('change' , function(e){
        if($('#super_admin_check').is(':checked')){
            $('#roles').attr('disabled', true)
        }else{
            $('#roles').removeAttr('disabled')
        }
    })
    
</script>
@endsection