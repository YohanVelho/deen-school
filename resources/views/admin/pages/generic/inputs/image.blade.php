@php
    $name = $input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '');
    $size = $input['size'] ?? 12;
    $width = $input['width'] ?? 150;
    $val = isset($value[$name]) ? $value[$name] : 'default.png';
    $ext = explode('.',$val)[1];
    $video = in_array($ext,["mp4","mov"]);
    $alt = $input['alt'] ?? true;
@endphp

<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <label class="form-control-label">{{$input['label']}}</label>
    <div style="width: {{$width}}px; {{isset($input['center']) ? 'margin: 0 auto;' : ''}}" class="mb-3">
        <video class="video_{{$name}}" src="{{ $video ? asset('storage/'.$val) : '' }}"  width="{{$width}}" <?php echo !$video ? 'style="display: none;"' : '' ?>></video>
        <img class="image_{{$name}}"  src="{{ !$video ? resize($val,$width) : '' }}" width="{{$width}}"  <?php echo $video ? 'style="display: none;"' : '' ?> />
        <div class="row m-0 w-100">
            <div class="col p-0">
                <div class="form-group m-0">
                    <label class="w-100 mb-0" for="{{$name}}">
                        <a class="btn btn-block btn-sm btn-success">
                            <i class="material-icons text-white" style="font-size: 15px;">cloud_upload</i>
                        </a>
                    </label>
                    <input type="hidden" name="{{$name}}" value="{{$value[$name] ?? ''}}" />
                    <input type="file" accept="*" style="display: none" id="{{$name}}" name="{{$name}}" value="{{old($name)}}"/>
                </div>
            </div>
            <div class="col p-0 @php echo !isset($value[$name]) ? 'd-none' : ''; @endphp">
                <a href="{{ asset('storage/'.$val) }}" data-fancybox="gallery" class="btn btn-block btn-sm btn-primary view_{{$name}}" href="#">
                    <i class="material-icons text-white" style="font-size: 15px;">visibility</i>
                </a>
            </div>
            <div class="col p-0">
                <a href="javascript:void(0);" class="btn btn-block btn-sm btn-danger remove_{{$name}}" href="#">
                    <i class="material-icons text-white" style="font-size: 15px;">delete</i>
                </a>
            </div>
        </div>
        @if ($alt)
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="{{$name}}_alt" class="form-control form-control-sm alt_{{$name}}" placeholder="Alt"  value="{{old($name.'_alt', ($value[$name.'_alt'] ?? ''))}}" />
            </div>
        </div>
        @endif
        @error($name)
            <span class="invalid-feedback d-block">{{$message}}</span>
        @enderror
        @if(isset($input['hint']))
            <p class="small text-muted">{{$input['hint']}}</p>
        @endif
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('input[name="{{ $name }}"]').on('change', function(evt) {
            const url = URL.createObjectURL(event.target.files[0]);
            const size = event.target.files[0].size;
            const name = event.target.files[0].name.split('.')[0]
            let ext = event.target.files[0].name.split('.');
            ext = ext[ext.length - 1];

            if (size > 5000 * 1024) {
                alert('Tamanho da imagem ou vídeo excede o permitido!(5MB)');
                return;
            }

            $('.alt_{{ $name }}').val(name);
            if (["mp4", "mov"].indexOf(ext) < 0) {
                $('.image_{{ $name }}').show();
                $('.video_{{ $name }}').hide();
                $('.image_{{ $name }}').attr('src', url);
                $('a.view_{{ $name }}').attr('href', url);
                $('a.view_{{ $name }}').parent().removeClass('d-none');
            } else {
                $('.image_{{ $name }}').hide();
                $('.video_{{ $name }}').show();
                $('.video_{{ $name }}').attr('src', url);
                $('a.view_{{ $name }}').parent().addClass('d-none');
            }
        });

        $('.remove_{{$name}}').on('click', function(){
            $('.image_{{$name}}').attr('src','storage/default.png');
            $('input[name="{{$name}}"]').val(null);
            $('.alt_{{$name}}').val('');
        });

    });

</script>
