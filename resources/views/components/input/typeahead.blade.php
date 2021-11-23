@props(['route' => $route])

<div class="container input-group">
    <span class="input-group-append">
        <span class="input-group-text" data-original-title="" title="" tabindex="0">
            <i class="fas fa-barcode"></i>
        </span>
    </span>
    <input class="typeahead form-control" type="text">
</div>

@push('page-js')
<script type="text/javascript">
    var path = "{{ ($route) }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endpush