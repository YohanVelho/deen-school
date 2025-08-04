@php
    $name = $input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '');
    $size = $input['size'] ?? 12;
    $type = $input['type'] ?? null;

    if($type == "multiple" && isset($value[$name])){
        $value[$name] = json_decode($value[$name]);
    }
@endphp
<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="form-group">
        <label class="form-control-label" for="{{$name}}">{{$input['label']}}</label>
        <select class="form-control @error($name) is-invalid @enderror" @php echo $type == "multiple" ? "multiple" : ''; @endphp id="{{$name}}" name="{{$name.($type == "multiple" ? "[]" : '')}}">
            @if($type != "multiple")
                <option value="" selected></option>
            @endif
            @foreach ($input['data'] as $data)
                <option value="{{$data['value']}}"
                    {{
                        (
                            (
                                (!is_array(old($name)) && old($name) == $data['value']) ||
                                (is_array(old($name)) && in_array($data['value'], old($name))) ||
                                (
                                    isset($value[$name]) && !is_array(old($name)) &&
                                    (
                                        (!is_array($value[$name]) && $value[$name] == $data['value']) ||
                                        (is_array($value[$name]) && in_array($data['value'], $value[$name]))
                                    )
                                )
                            )
                        ) ? 'selected' : ''
                    }}>
                    {{$data['description']}}
                </option>
            @endforeach
        </select>
        @error($name)
            <span class="invalid-feedback">{{$message}}</span>
        @enderror
        @if(isset($input['hint']))
            <p class="small text-muted">{{$input['hint']}}</p>
        @endif
    </div>
</div>
