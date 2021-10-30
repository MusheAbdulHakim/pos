@props(['message' => $message])
<div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
    <i class="mdi mdi-alert-circle-outline mr-2"></i> {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>