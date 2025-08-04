@php
    $name = $input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '');
    $size = $input['size'] ?? 12;
    $val = $value[$name] ?? $input['default'] ?? 1;
@endphp


<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="row align-items-center" style="justify-content: center;">
        @foreach ($input['data'] as $data)
            <div class="col-lg-4 image-select">
                <input type="radio" id="{{$name.'_'.$data['value']}}" name="{{$name}}" value="{{$data['value']}}" {{ $data['value'] == $val ? 'checked' : ''}} />
                <label for="{{$name.'_'.$data['value']}}">
                    <img src="{{$data['image']}}" />
                </label>
            </div>
        @endforeach
    </div>
</div>
