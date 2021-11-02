@props(['name'=>$name,'options'=>$options ,'key' => $key])

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

<select name="{{$name}}" class="form-control select2" multiple="multiple" data-placeholder="Choose ..." id="{{$name}}">
    @foreach ($options as $option)
        <option>{{$option->$key}}</option><option selected disabled>No Tax Method </option>
    @endforeach
</select>


@push('page-js')
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script>
    $('.select2').select2();
</script>
@endpush
