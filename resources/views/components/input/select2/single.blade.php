@props(['name'=>$name,'options'=>$options ,'key' => $key,'selected' => $selected ?? ''])

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

<select name="{{$name}}" id="{{$name}}" class="form-control select2">
    @foreach ($options as $option)
        <option {{$option->$key == $selected ? 'selected': ''}} value="{{$option->id}}">{{$option->$key}}</option>
    @endforeach        
</select>

@push('page-js')
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

<script>
    $('.select2').select2();
</script>
@endpush
