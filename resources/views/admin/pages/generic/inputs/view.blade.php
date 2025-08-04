@php
    $name = $input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '');
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="form-group">
        <label class="form-control-label">{{$input['label']}}</label>
        <input type="text" readonly class="form-control-plaintext" value="{{$value[$name] ?? ''}}">
        @if(isset($input['hint']))
            <p class="small text-muted">{{$input['hint']}}</p>
        @endif
    </div>
</div>
