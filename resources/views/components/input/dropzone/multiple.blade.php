@push('page-css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

<form action="#" class="dropzone">
    <div class="fallback">
        <input name="file" type="file" multiple="multiple">
    </div>
    <div class="dz-message needsclick">
        <div class="mb-3">
            <i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
        </div>

        <h4>Drop files here or click to upload.</h4>
    </div>
</form>

{{-- <div class="dropzone">
    <input type="file" name="file" id="">
</div> --}}

@push('page-js')
    <!-- Plugins js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
@endpush

