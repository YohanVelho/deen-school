@php
    $name = $tinput['parent'].'['.$tinput['index'].']['.$tinput['name'].(isset($tinput['lang']) ? '_'.$tinput['lang'] : '').']';
    $size = $tinput['size'] ?? "";
    $tval = $value[$tinput['parent']][$tinput['index']][$tinput['name']] ?? '';
@endphp
<td width="{{$size}}" style="padding: 5px;">
    <div class="form-group m-0">
        <select class="form-control @error($name) is-invalid @enderror" name="{{$name}}">
            <option value="" selected></option>
            @foreach ($tinput['data'] as $data)
                <option value="{{$data['value']}}"
                    {{old($name, $tval) == $data['value'] ? 'selected' : ''}}>
                    {{$data['description']}}
                </option>
            @endforeach
        </select>
        @error($name)
            <span class="invalid-feedback">{{$message}}</span>
        @enderror
        @if(isset($tinput['hint']))
            <p class="small text-muted">{{$tinput['hint']}}</p>
        @endif
    </div>
</td>
