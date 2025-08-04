@php
    $name = $input['name'];
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <label class="form-control-label">{{$input['label']}}</label>
    <div class="mb-3">
        <div class="row m-0 w-100">
            <div class="col p-0">
                <div class="form-group m-0">
                    <label class="w-100" for="{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '' )}}">
                        <a class="btn btn-block btn-sm btn-success">
                            <i class="material-icons text-white" style="font-size: 15px;">cloud_upload</i>
                        </a>
                    </label>
                    <input type="file" style="display: none" id="{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '' )}}" name="{{ $name.(isset($input['lang']) ? '['.$input['lang'].']' : '') }}" value="{{old(isset($input['lang']) ? $name.'['.$input['lang'].']'  : $name, isset($input['lang']) ? $value[$name][$input['lang']] ?? '' : $value[$name] ?? '')}}"/>
                <p class="small" id="name_{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '' )}}">{{isset($input['lang']) ? $value[$name][$input['lang']] ?? '' : $value[$name] ?? ''}}</p>
                </div>
            </div>
        </div>
        @error($name)
            <span class="invalid-feedback d-block">{{$message}}</span>
        @enderror
        @if(isset($input['hint']))
            <p class="small text-muted">{{$input['hint']}}</p>
        @endif
    </div>
</div>

<script>
    $(function(){
        $('#{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '' )}}').on('change', function(){
           $("#name_{{$name.(isset($input['lang']) ? '_'.$input['lang'] : '' )}}").html($(this).val().match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1])
        })
    })
</script>
