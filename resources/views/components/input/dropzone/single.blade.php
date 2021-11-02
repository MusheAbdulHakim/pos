@props(['name' => $name ?? 'image','route' => $route])
@push('page-css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endpush


<div class="dropzone">
    <div class="fallback">
        <input name="{{$name}}" type="file" >
    </div>
    <div class="dz-message needsclick">
        <div class="mb-3">
            <i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
        </div>
        <h4>Drop file here or click to upload.</h4>
    </div>
</div>

@push('page-js')
    <!-- Plugins js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script>
        Dropzone.options.fileDropzone = {
          url: '{{$route}}',
          acceptedFiles: ".jpeg,.jpg,.png,.gif",
          addRemoveLinks: true,
          maxFilesize: 8,
          removedfile: function(file)
          {
            var name = file.upload.filename;
            $.ajax({
              type: 'POST',
              url: '{{ $route }}',
              data: { "_token": "{{ csrf_token() }}", name: name},
              success: function (data){
                  console.log("File has been successfully removed!!");
              },
              error: function(e) {
                  console.log(e);
              }});
              var fileRef;
              return (fileRef = file.previewElement) != null ?
              fileRef.parentNode.removeChild(file.previewElement) : void 0;
          },
          success: function (file, response) {
            console.log(file);
          },
        }
      </script>
@endpush

