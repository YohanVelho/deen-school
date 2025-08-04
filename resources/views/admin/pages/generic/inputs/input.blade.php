@php
    $name = $input['name'];
    $type = $input['type'] ?? 'text';
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="form-group">
        <label class="form-control-label" for="{{$name}}">{{$input['label']}}</label>
        @if(isset($input['append']) || isset($input['prepend']))
        <div class="input-group">
            @if(isset($input['prepend']))
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {{$input['prepend']}}
                </span>
            </div>
            @endif
        @endif
            <input type="{{$type}}" class="form-control @error( $name.(isset($input['lang']) ? '['.$input['lang'].']' : '')) is-invalid @enderror" id="{{$name}}" name="{{ $name.(isset($input['lang']) ? '['.$input['lang'].']' : '') }}" value="{{old(isset($input['lang']) ? $name.'['.$input['lang'].']'  : $name, isset($input['lang']) ? $value[$name][$input['lang']] ?? '' : $value[$name] ?? '')}}"/>
            @error( $name.(isset($input['lang']) ? '['.$input['lang'].']' : ''))
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
            @if(isset($input['hint']))
                <p class="small text-muted">{{$input['hint']}}</p>
            @endif
        @if(isset($input['append']) || isset($input['prepend']))
            @if(isset($input['append']))
            <div class="input-group-append">
                <span class="input-group-text">
                    {{$input['append']}}
                </span>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
