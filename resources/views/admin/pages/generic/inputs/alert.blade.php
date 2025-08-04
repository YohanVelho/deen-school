@php
    $type = isset($input['type']) ? $input['type'] : 'warning';
@endphp

<div class="col-md-12">
    <div class="alert align-items-center alert-{{$type}} d-flex">
        <span class="alert-icon">
            <i class="material-icons">{{$type}}</i>
        </span>
        <span class="alert-text text-center col">{!!$input['text']!!}</span>
    </div>
</div>
