@props(['text'=>$text ?? 'Button','target'=>$target ?? '','link'=>$link ?? 'javascript:void(0);', 'id'=> $id ?? ''])
<a href="{{($link)}}">
    <button type="button" id="{{$id}}" class="btn btn-primary" data-toggle="modal" data-target="{{$target}}">
        <i class="fas fa-plus"></i> {{$text}}
    </button>
</a>