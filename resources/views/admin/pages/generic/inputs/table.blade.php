@php
    $name = $input['name'];
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}">
    <table id="table-{{$name}}" class="table table-striped">
        <thead>
            <tr>
                @if(isset($input['sortable']))
                    <th style="width: 25px;">
                        <i class="material-icons" style="font-size: 18px;">sort</i>
                    </th>
                @endif
                @foreach ($input['inputs'] as $item)
                    @if(!isset($item['input']) || $item['input'] != 'hidden')
                        <th>
                            {{$item['label']}}
                        </th>
                    @endif
                @endforeach
                <th width="50">
                </th>
            </tr>
        </thead>
        <tbody>
            @if (isset($value[$name]))
                @foreach ($value[$name] as $index => $tvalue)
                <tr>
                    @if(isset($input['sortable']))
                        <td style="width: 25px; vertical-align: middle;">
                            <i class="material-icons" style="font-size: 18px;">swap_vert</i>
                            <input type="hidden" class="sortable-position" name="{{$name}}[{{$index}}][{{$input['sortable']}}]" value="{{$index + 1}}" />
                        </td>
                    @endif

                    @foreach ($input['inputs'] as $tinput)
                        @php
                            $tinput['index'] = $index;
                            $tinput['parent'] = $name;
                        @endphp

                        @if (isset($tinput['translate']) && $tinput['translate'] && $translate)
                            @foreach ($languages as $i => $lang)
                                @php
                                    $tinput['lang'] = $lang['slug'];
                                @endphp
                                @include('admin.pages.generic.table.'.($tinput['input'] ?? 'input'), [
                                    'tinput' => $tinput
                                ])
                            @endforeach
                        @else
                            @include('admin.pages.generic.table.'.($tinput['input'] ?? 'input'), [
                                'tinput' => $tinput
                            ])
                        @endif
                    @endforeach

                    <td style="padding: 7px 5px; vertical-align: middle;">
                        @include('admin.pages.generic.table.hidden', [
                            'tinput' => [
                                'index' => $index,
                                'parent' => $name,
                                'name' => 'deleted'
                            ]
                        ])
                        <a class="btn btn-sm text-white btn-danger table-delete mr-2">
                            <i class="material-icons" style="font-size: 18px;">delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <template>
        <tr>
            @if(isset($input['sortable']))
                <td style="width: 25px; vertical-align: middle;">
                    <i class="material-icons" style="font-size: 18px;">swap_vert</i>
                    <input type="hidden" class="sortable-position" name="{{$input['sortable']}}[{index}]" value="{index}" />
                </td>
            @endif

            @foreach ($input['inputs'] as $tinput)
                @php
                    $tinput['index'] = '{index}';
                    $tinput['parent'] = $name;
                @endphp

                @if (isset($tinput['translate']) && $tinput['translate'] && $translate)
                    @foreach ($languages as $i => $lang)
                        @php
                            $tinput['lang'] = $lang['slug'];
                        @endphp
                        @include('admin.pages.generic.table.'.($tinput['input'] ?? 'input'), [
                            'tinput' => $tinput
                        ])
                    @endforeach
                @else
                    @include('admin.pages.generic.table.'.($tinput['input'] ?? 'input'), [
                        'tinput' => $tinput
                    ])
                @endif
            @endforeach

            <td style="padding: 7px 5px; vertical-align: middle;">
                @include('admin.pages.generic.table.hidden', [
                    'tinput' => [
                        'index' => '{index}',
                        'parent' => $name,
                        'name' => 'deleted'
                    ]
                ])
                <a class="btn btn-sm text-white btn-danger table-delete mr-2">
                    <i class="material-icons" style="font-size: 18px;">delete</i>
                </a>
            </td>
        </tr>
    </template>
    <div class="float-right my-3 mr-2">
        <a href="javascript:void(0);" class="btn btn-sm btn-success table-add">
            + ADICIONAR
        </a>
    </div>
</div>


@if (isset($input['sortable']))
    <script type="text/javascript">
        $(function(){
            $('#table-{{$name}} tbody').sortable({
                update: function(event){
                    const lines = $('#table-{{$name}} tbody tr');
                    for(let i=0; i<lines.length; i++){
                        lines.eq(i).find('.sortable-position').val(i);
                    }
                }
            });
        });
    </script>
@endif
