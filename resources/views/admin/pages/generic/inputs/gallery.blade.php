@php
    $name = $input['name'];
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}">
    <div class="gallery-empty text-center my-3">
        <i class="material-icons" style="font-size: 40px;">add_photo_alternate</i>
        <h3>Nenhuma imagem adicionada</h3>
        <p>Clique no botão abaixo para adicionar</p>
    </div>

    <div id="gallery-{{$name}}" class="gallery row">
        @if (isset($value[$name]))
            @foreach ($value[$name] as $index => $tvalue)
                <div class="col-md-3 gallery-item">
                    <div class="card">
                        <div class="card-body p-0">
                            <input type="hidden" name="{{$name}}[{{$index}}][id]" value="{{$tvalue['id']}}" />
                            <div style="margin: 0 auto;">
                                @include('admin.pages.generic.inputs.image', [
                                    'input' => [
                                        'index' => $index,
                                        'parent' => $name,
                                        'name' => $input['image'],
                                        'label' => ''
                                    ]
                                ])
                            </div>
                            <div class="row p-2 align-items-center m-0" style="background: #EAEAEA;">
                                <div>
                                    <input type="hidden" class="sortable-position" name="{{$name}}[{{$index}}][{{$input['sortable']}}]" value="{{$index}}" />
                                    <i class="material-icons" style="font-size: 18px;">open_with</i>
                                </div>
                                <div class="col text-center">
                                    <p class="text-muted small m-0">Arraste para ordenar</p>
                                </div>
                                <div>
                                    <input type="hidden" name="{{$name}}[{{$index}}][deleted]" value="0" />
                                    <a class="gallery-delete" href="javascript:void(0);">
                                        <i class="material-icons text-danger" style="font-size: 18px;">delete</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>


   <template>
        <div class="col-md-3 gallery-item">
            <div class="card">
                <div class="card-body p-0">
                    <div style="margin: 0 auto;">
                        @include('admin.pages.generic.inputs.image', [
                            'input' => [
                                'index' => '{index}',
                                'parent' => $name,
                                'name' => $input['image'],
                                'label' => '',
                                'center' => true
                            ]
                        ])
                    </div>
                    <div class="row p-2 align-items-center m-0" style="background: #EAEAEA;">
                        <div>
                            <input type="hidden" class="sortable-position" name="{{$name}}[{index}][{{$input['sortable']}}]" value="{index}" />
                            <i class="material-icons" style="font-size: 18px;">open_with</i>
                        </div>
                        <div class="col text-center">
                            <p class="text-muted small m-0">Arraste para ordenar</p>
                        </div>
                        <div>
                            <input type="hidden" name="{{$name}}[{index}][deleted]" value="0" />
                            <a class="gallery-delete" href="javascript:void(0);">
                                <i class="material-icons text-danger" style="font-size: 18px;">delete</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <div class="float-right my-3 mr-2">
        <a href="javascript:void(0);" class="btn btn-sm btn-success gallery-add">
            + ADICIONAR
        </a>
    </div>
</div>



@if (isset($input['sortable']))
    <script type="text/javascript">
        $(function(){
            $('#gallery-{{$name}}').sortable({
                update: function(event){
                    const lines = $('#gallery-{{$name}} .gallery-item');
                    for(let i=0; i<lines.length; i++){
                        lines.eq(i).find('.sortable-position').val(i);
                    }
                }
            });
        });
    </script>
@endif
