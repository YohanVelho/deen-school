@php
    $name = $tinput['parent'].'['.$tinput['index'].']['.$tinput['name'].(isset($tinput['lang']) ? '_'.$tinput['lang'] : '').']';
    $tval = $value[$tinput['parent']][$tinput['index']][$tinput['name']] ?? '';
@endphp

<input type="hidden" name="{{$name}}" value="{{old($name, $tval)}}"/>
