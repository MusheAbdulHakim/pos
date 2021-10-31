@props(['name'=>$name,'options'=>$options,'multiple'=>$multiple ?? ''])

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

<label for="{{$name}}">{{ucwords($name)}}</label>
<select name="{{$name}}" class="form-control" {{!empty($multiple) ? "multiple='multiple'" : ''}} id="{{$name}}">
    @foreach ($options as $option => $value)
        <option>{{$value}}</option>
    @endforeach
</select>


@push('page-js')
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script>
    $('.select2').select2();
</script>
@endpush
