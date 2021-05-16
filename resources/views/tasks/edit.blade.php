@extends('layouts.master')
@section('title')
   إضافة فواتير
@stop
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}"> --}}
     <!--Internal   Notify -->
     <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">
                    <a href="/tasks">المهمات</a>
                    </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل التاسك</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="post" autocomplete="off">
                        @csrf
                        @method('PUT')
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">العنوان</label>
                                <input type="text" class="form-control  @error('subject') is-invalid @enderror" id="subject" name="subject"
                                    value="{{$task->subject}}">
                                    @error('subject')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label>تاريخ التاسك</label>
                                <input class="form-control fc-datepicker @error('date') is-invalid @enderror" name="date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{$task->date}}">
                                    @error('date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label>الساعة التاسك</label>
                                <input class="form-control timepicker @error('time') is-invalid @enderror" name="time" placeholder="YYYY-MM-DD"
                                    type="text" value="{{$task->time}}">
                                    @error('time')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label> الوقت المكرس بالساعة</label>
                                <input type="number" class="form-control @error('dedicated_time') is-invalid @enderror" name="dedicated_time" name="dedicated_time" value="{{$task->dedicated_time}}">
                                    @error('dedicated_time')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                          <br>
                          {{-- 2 --}}
                          <div class="row">
                            <div class="col">
                                <label> الوقت المتوقت بالساعة</label>
                                <input type="number" class="form-control @error('estimated_time') is-invalid @enderror" name="estimated_time" value="{{$task->estimated_time}}">
                                    @error('estimated_time')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                @php
                                    $clients = \App\Client::all();
                                @endphp
                                <label>موجهة للعميل</label>
                                <select class="form-control select2" name="client_id">
                                    <option value="">من فضلك قم بإختيار العميل</option>
                                 @foreach ($clients as $client)
                                    <option value="{{$client->id}}" {{$task->client_id == $client->id ? 'selected' : ''}}>{{$client->legal_name}}
                                 - <span>{{$client->name}}</span>
                                 </option>
                                 @endforeach
                                </select>   
                                    @error('client_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label>المكلف بالمهمة</label>
                                <select class="form-control select2" name="user_id">
                                    <option value="">من فضلك قم بإختيار المستخدم</option>
                                 @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{$task->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}
                                 </option>
                                 @endforeach
                                </select>   
                                    @error('user_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label> الوصف</label>
                            <textarea name="description" id="" class="form-control">{{$task->description}}</textarea>
                            </div>
                        </div>
                        <br>
                        {{-- end 2 --}}
                          <div class="custom-controls-stacked">
                            <label class="ckbox mg-b-10"><input type="checkbox" id="completed" name="completed"  {{$task->completed == 1 ? 'checked' : ''}}><span>Set As Completed</span></label>
                        </div>
                          <div class="custom-controls-stacked">
                            <label class="ckbox mg-b-10"><input type="checkbox" id="important" name="important" {{$task->important == 1 ? 'checked' : ''}}><span>Set As Important</span></label>
                        </div>
                        
                        <br>
                        <br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>
                    </form>
                    {{-- End form --}}
                </div>
            </div>
        </div>
        <!--/div-->
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
   <!--Internal Fileuploads js-->
   <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
   <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
   <!--Internal Fancy uploader js-->
   <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
   <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
   <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
   <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
   <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
   <!--Internal  Form-elements js-->
   <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
   <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
   <!--Internal Sumoselect js-->
   <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
   <!--Internal  Datepicker js -->
   <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
   <!--Internal  jquery.maskedinput js -->
   {{-- <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script> --}}
   <!--Internal  spectrum-colorpicker js -->
   {{-- <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script> --}}
   <!-- Internal form-elements js -->
   <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>

         $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('input[type=checkbox]').on('change', function(e){
            console.log(e)
            if($('input[type=checkbox]').is(':checked')){
               $('#amount_paid').attr('disabled', true)
               $('#status').attr('disabled', true)
            }else{
                $('#amount_paid').removeAttr('disabled')
               $('#status').removeAttr('disabled')
            }
        })  

        $('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    defaultTime: '{{$task->time ?? 11}}',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
    </script>

    <script>
    </script>
@endsection
