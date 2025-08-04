@php
    $name = $input['name'];
    $size = $input['size'] ?? 12;
    $heigth = $input['heigth'] ?? 100;
    $inline = isset($input['inline']) ? $input['inline'] : false;
    $richtext = isset($input['richtext']) ? $input['richtext'] : (!$inline ? true : false);
@endphp


<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="form-group">
        <label class="form-control-label" for="{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '')}}">{{$input['label']}}</label>
        <textarea class="form-control {{ $richtext ? 'ckeditor_'.$name.(isset($input['lang']) ? '_'.$input['lang'] : '') : ''}} @error($name.(isset($input['lang']) ? '['.$input['lang'].']' : '')) is-invalid @enderror" style="height: {{$heigth}}px;" id="{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '')}}" name="{{ $name.(isset($input['lang']) ? '['.$input['lang'].']' : '') }}">{{old(isset($input['lang']) ? $name.'['.$input['lang'].']'  : $name, isset($input['lang']) ? $value[$name][$input['lang']] ?? '' : $value[$name] ?? '')}}</textarea>
        @error($name.(isset($input['lang']) ? '['.$input['lang'].']' : ''))
            <span class="invalid-feedback">{{$message}}</span>
        @enderror
        @if(isset($input['hint']))
            <p class="small text-muted">{{$input['hint']}}</p>
        @endif
    </div>
</div>

@if($richtext)
    <script>
        CKEDITOR.replace( '{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '')}}', {
            forcePasteAsPlainText: true,
            pasteFromWordPromptCleanup: true,
            pasteFromWordRemoveFontStyles: true,
            ignoreEmptyParagraph: true,
            removeFormatAttributes: true
        });
    </script>
@endif

@if($inline)
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.inline( '{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '')}}' , {
				toolbar: [
                    { name: 'basicstyles', items : [ 'Bold','Italic','-'] },
                    { name: 'links', items : [ 'Link'] },
                    { name: 'paragraph', groups: [ 'list'], items: [ 'NumberedList', 'BulletedList'] },
                ],
                forcePasteAsPlainText: true,
                pasteFromWordPromptCleanup: true,
                pasteFromWordRemoveFontStyles: true,
                ignoreEmptyParagraph: true,
                removeFormatAttributes: true,
                autoParagraph : false,
                enterMode : CKEDITOR.ENTER_BR
			});
    </script>
@endif

