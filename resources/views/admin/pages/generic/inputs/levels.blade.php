@php
    $name = $input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '');
    $size = $input['size'] ?? 12;
    if(!is_array($input['data'])){
        $input['data'] = $data[$input['data']];
    }
@endphp

<div class="col-md-{{$size}}">
    <div class="form-group">
        <div class="multi-select">
            <label class="form-control-label" for="{{$name}}">{{$input['label']}}</label>
                    <div class="options">
                        @foreach ($input['data'] as $index => $data)
                            <div class="option">
                                    @php
                                        $exists = false;
                                    @endphp
                                    @if (isset($value[$name]))
                                        @foreach($value[$name] as $pivo)
                                        @if ($pivo[$input['value']] == $data['value'])
                                            @php
                                                $exists = $pivo['id'];
                                            @endphp
                                        @endif
                                    @endforeach
                                    @endif

                                    @if($exists)
                                        <input type="hidden" name="{{$name}}[{{$index}}][id]" value="{{$exists}}" />
                                    @endif

                                    <input type="hidden" name="{{$name}}[{{$index}}][{{$input['value']}}]" value="{{$data['value']}}" />
                                    <input id="{{$name.'_'.$index}}" name="{{$name}}[{{$index}}][checked]" type="checkbox" {{$exists ? 'checked' : ''}}>
                                    <label class="custom-options" for="{{$name.'_'.$index}}">{{$data['description']}}</label>
                            </div>
                        @endforeach
                    </div>
            @if(isset($input['hint']))
                <p class="small text-muted">{{$input['hint']}}</p>
            @endif
        </div>
    </div>
</div>
