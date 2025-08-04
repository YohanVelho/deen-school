@extends('admin.master.layout')

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="m-3">
                    <h6 class="h2 text-white d-inline-block mb-0">Dicionário</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Dicionário</li>
                        </ol>
                    </nav>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('translations.create') }}">
                        @csrf
                        <div class="row align-items-end mb-5">
                            <div class="col-md-4">
                                <label>Chave:</label>
                                <input type="text" name="key" class="form-control" placeholder="Chave">
                            </div>
                            <div class="col-md-4">
                                <label>Valor:</label>
                                <input type="text" name="value" class="form-control" placeholder="Valor">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Adicionar</button>
                            </div>
                        </div>
                    </form>


                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Chave</th>
                            @if($languages->count() > 0)
                                @foreach($languages as $language)
                                    <th>{{ $language->name }} ({{ $language->slug }})</th>
                                @endforeach
                            @endif
                            <th width="80px;">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($columnsCount > 0)
                                @foreach($columns[0] as $columnKey => $columnValue)
                                    <tr>
                                        <td><a href="#" class="translate-key" data-title="Enter Key" data-type="text" data-pk="{{ $columnKey }}" data-url="{{ route('translation.update.json.key') }}">{{ $columnKey }}</a></td>
                                        @for($i=1; $i<=$columnsCount; ++$i)
                                        <td><a href="#" data-title="Enter Translate" class="translate" data-code="{{ $columns[$i]['lang'] }}" data-type="textarea" data-pk="{{ $columnKey }}" data-url="{{ route('translation.update.json') }}">{{ isset($columns[$i]['data'][$columnKey]) ? $columns[$i]['data'][$columnKey] : '' }}</a></td>
                                        @endfor
                                        <td><button data-action="{{ route('translations.destroy', $columnKey) }}" class="btn btn-danger btn-sm remove-key">  <i class="material-icons text-white" style="font-size: 15px;">delete</i></button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

