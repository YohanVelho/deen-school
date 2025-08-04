@php
    $name = $input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '');
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="form-group">
        <label class="form-control-label" for="{{$name}}">{{$input['label']}}</label>
        <div class="tag-container tag-container--{{$name}}">
            <input type="hidden" class="form-control tag-container__value" value="{{old($name, ($value[$name] ?? ''))}}" name="{{$name}}" style="border: none;">
            <input type="text" class="form-control tag-container__input" style="border: none;">
        </div>
        @error($name)
        <span class="invalid-feedback">{{$message}}</span>
        @enderror
        @if(isset($input['hint']))
            <p class="small text-muted">{!! $input['hint'] !!}</p>
        @endif
    </div>
</div>
 <script defer>
     $(function () {
        new Tags(
            document.querySelector('.tag-container--{{$name}}')
        ).init();
     });
</script>
