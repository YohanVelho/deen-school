@php

// input
// value

@endphp

<div class="col-md-12" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Título</label>
                <input type="text" name="seo[title][pt]" class="form-control" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="seo[description]" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
