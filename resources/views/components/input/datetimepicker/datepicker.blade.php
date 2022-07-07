@props(['name' => $name, 'value' => $value ?? old($name)])

@push('page-css')
    <link rel="stylesheet" href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
@endpush

<div class="input-group">
    <input type="text" class="form-control" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true" name="{{$name}}" value="{{$value}}">
    <div class="input-group-append">
        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
</div>

@push('page-js')
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
@endpush