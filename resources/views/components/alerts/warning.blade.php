@props(['message' => $message])
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="mdi mdi-alert-outline mr-2"></i> {{$message}}!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>