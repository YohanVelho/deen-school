@php
$name = $input['name'] . (isset($input['lang']) ? '_' . $input['lang'] : '');
$size = $input['size'] ?? 12;
if (!is_array($input['data'])) {
    $input['data'] = $data[$input['data']];
}
@endphp

<div class="col-md-{{ $size }}">
    <div class="form-group">
        <div class="multi-select" id="multi-select-{{$name}}">
            <label class="form-control-label" for="{{ $name }}">{{ $input['label'] }}</label>
            <div class="row mt-1 mb-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control js-search" placeholder="Procurar..."
                            onkeyup="filterFunction()">
                    </div>
                </div>
          </div>
            <div class="options">
                @foreach ($input['data'] as $index => $data)
                    <div class="option">
                        @php
                            $exists = false;
                            $order = '';
                        @endphp
                        @if (isset($value[$name]))
                            @foreach ($value[$name] as $pivo)
                                @if ($pivo[$input['value']] == $data['value'])
                                    @php
                                        $exists = $pivo['id'];
                                        $order = $pivo['order'];
                                    @endphp
                                @endif
                            @endforeach
                        @endif

                        @if ($exists)
                            <input type="hidden" name="{{ $name }}[{{ $index }}][id]"
                                value="{{ $exists }}" />
                        @endif
                        @if(isset($input['sortable']))
                            <i class="material-icons" style="font-size: 18px;">swap_vert</i>
                            <input type="hidden" class="sortable-position" name="{{$name}}[{{$index}}][{{$input['sortable']}}]" value="{{ $order }}" />
                        @endif
                        <input type="hidden" name="{{ $name }}[{{ $index }}][{{ $input['value'] }}]" value="{{ $data['value'] }}" />
                        <input id="{{ $name . '_' . $index }}" class="js-option" name="{{ $name }}[{{ $index }}][checked]"
                            type="checkbox" {{ $exists ? 'checked' : '' }}>
                        <label class="custom-options" for="{{ $name . '_' . $index }}">{{ $data['description'] }}</label>
                    </div>
                @endforeach
            </div>
            @if (isset($input['hint']))
                <p class="small text-muted">{{ $input['hint'] }}</p>
            @endif
        </div>
    </div>
    <script>
        function filterFunction() {
            let input = document.querySelector(".js-search");
            let filter = input.value.toUpperCase();
            let options = document.querySelector(".options");
            let option = options.querySelectorAll(".option");
            for (i = 0; i < option.length; i++) {
                txtValue = option[i].textContent || option[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    option[i].style.display = "";
                } else {
                    option[i].style.display = "none";
                }
            }
        }
    </script>
</div>

@if (isset($input['sortable']))
    <script type="text/javascript">
        $(function(){

            $('#multi-select-{{$name}} .options').sortable({
                update: update
            });

            function update(){
                const lines = $('#multi-select-{{$name}} .options .option');
                for(let i=0; i<lines.length; i++){
                    lines.eq(i).find('.sortable-position').val(i+1);
                }
            }
        });
    </script>
@endif

<script>
    var list = $("#multi-select-{{$name}} .options"),
    origOrder = list.children();

    checkIfIsChecked(origOrder);

    list.on("click", ".js-option", function() {
        checkIfIsChecked(origOrder);
    });

    function checkIfIsChecked(origOrder){
        var checked = document.createDocumentFragment();
        var unchecked = document.createDocumentFragment();
        for (var i = 0; i < origOrder.length; i++) {
            if (origOrder[i].querySelector(".js-option").checked) {
                checked.appendChild(origOrder[i]);
            } else {
                unchecked.appendChild(origOrder[i]);
            }
        }
        
        list.append($(checked).children().sort(sortNum)).append(unchecked);
    }
    function sortNum(a,b){  
        return parseInt($(a).find('.sortable-position').val()) > parseInt($(b).find('.sortable-position').val()) ? 1 : -1;  
    };

</script>
