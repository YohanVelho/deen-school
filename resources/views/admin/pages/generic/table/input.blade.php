@php
    $name = $tinput['parent'].'['.$tinput['index'].']['.$tinput['name'].(isset($tinput['lang']) ? '_'.$tinput['lang'] : '').']';
    $type = $tinput['type'] ?? 'text';
    $size = $tinput['size'] ?? "";
    $tval = $value[$tinput['parent']][$tinput['index']][$tinput['name']] ?? '';
@endphp

<td width="{{$size}}" style="padding: 5px;" {{ isset($tinput['lang']) ? 'data-lang='.$tinput['lang'] : ''}}>
    <div class="form-group m-0">
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

            <input type="{{$type}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" value="{{old($name, $tval)}}"/>
            @error($name)
                <span class="invalid-feedback">{{$message}}</span>
            @enderror
            @if(isset($tinput['hint']))
                <p class="small text-muted">{{$tinput['hint']}}</p>
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
</td>
