@php
    $size = $input['size'] ?? 12;
@endphp


<div class="col-md-{{$size}}">
    <a class="btn btn-primary btn--external" href="javascript:void(0);" data-action-link="{{$input['link']}}">
        {{$input['label']}}
        <i class="material-icons">north_east</i>
    </a>
</div>
