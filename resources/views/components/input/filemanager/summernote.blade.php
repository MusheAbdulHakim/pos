@props(['name' => $name])

@push('page-css')
    <!-- Summernote css -->
    <link href="{{asset('assets/libs/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
<textarea name="{{$name}}" id="summernote"></textarea>

@push('page-js')
<!-- Summernote js -->
<script src="{{asset('assets/libs/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(document).ready(function(){
      // File manager button (image icon)
      const FMButton = function(context) {
        const ui = $.summernote.ui;
        const button = ui.button({
          contents: '<i class="note-icon-picture"></i> ',
          tooltip: 'File Manager',
          click: function() {
            window.open('/file-manager/summernote', 'fm', 'width=1400,height=800');
          }
        });
        return button.render();
      };
      $('#summernote').summernote({
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['fm-button', ['fm']],
        ],
        buttons: {
          fm: FMButton
        }
      });
    });
    // set file link
    function fmSetLink(url) {
      $('#summernote').summernote('insertImage', url);
    }
  </script>
@endpush