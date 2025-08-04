@php
    $name = $tinput['parent'].'['.$tinput['index'].']['.$tinput['name'].']';
    $size = $input['size'] ?? '';
    $heigth = $input['heigth'] ?? 100;
    $tval = $value[$tinput['parent']][$tinput['index']][$tinput['name']] ?? '';
@endphp


<td width="{{$size}}">
    <textarea class="form-control {{ $richtext ? 'ckeditor_'.$name : ''}} @error($name) is-invalid @enderror" style="height: {{$heigth}}px;" id="{{$name}}" name="{{ $name }}">{{old($name,$tval)}}</textarea>
    @error($name)
        <span class="invalid-feedback">{{$message}}</span>
    @enderror
</td>

<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( '{{$name}}' , {
            toolbar: [
                { name: 'basicstyles', items : [ 'Bold','Italic','-'] },
                { name: 'links', items : [ 'Link'] },
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
