@if ($status == 'Unpaid')
<span class="text-white btn btn-warning">
    {{$status}}
</span>
@else
<span class="text-white btn btn-success">
    {{$status}}
</span>
@endif