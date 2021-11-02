@props(['name' => $name])
<div class="input-group">
    <input id="image_label" type="text" class="form-control" name="{{$name}}"
           aria-label="Image" aria-describedby="button-image">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
    </div>
</div>
@push('page-js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('button-image').addEventListener('click', (event) => {
        event.preventDefault();
        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
      });
    });
    // set file link
    function fmSetLink($url) {
      document.getElementById('image_label').value = $url;
    }
  </script>
@endpush