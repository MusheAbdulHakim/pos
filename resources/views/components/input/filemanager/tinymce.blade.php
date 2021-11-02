@props(['name' => $name, 'value' => $value ??''])

@push('page-css')
    
@endpush

<textarea id="my-textarea" name="{{$name}}">{{$value}}</textarea>

@push('page-js')
<!--tinymce js-->
<script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      tinymce.init({
        selector: '#my-textarea',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table directionality',
          'emoticons template paste textpattern',
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
          tinyMCE.activeEditor.windowManager.open({
            file: '/file-manager/tinymce',
            title: 'Laravel File Manager',
            width: window.innerWidth * 0.8,
            height: window.innerHeight * 0.8,
            resizable: 'yes',
            close_previous: 'no',
          }, {
            setUrl: function(url) {
              win.document.getElementById(field_name).value = url;
            },
          });
        },
      });
    });
  </script>
@endpush