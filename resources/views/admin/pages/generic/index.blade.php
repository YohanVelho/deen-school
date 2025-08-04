@extends('admin.master.layout')

@section('content')

  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">

        <div class="row align-items-center py-4">
            <a class="mobile-menu d-xl-none ml-3" href="javascript:void(0);">
                <i class="material-icons">menu</i>
            </a>
          <div class="m-3">

            @if(session('last') && count(session('last')) > 0)
                <a href="{{route('admin.back')}}" class="btn">
                    <i class="material-icons text-white">arrow_back</i>
                </a>
            @endif

            <h2 class="h2 text-white d-inline-block mb-0">{{$title}}</h2>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
              </ol>
            </nav>
          </div>

          @if($add)
            <div class="col text-right"">
                <a href="{{route(Route::currentRouteName().'.create', ['fk' => Request::route('fk')])}}" class="btn btn-neutral">
                    <i class="material-icons float-left mr-2" style="font-size: 20px;">add</i>
                    ADICIONAR
                </a>
            </div>
          @endif
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
      </div>

    </div>
  </div>
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header border-0">
              <div class="row align-items-center m-0">
                  <div class="col p-0">
                    <h3 class="mb-0">Listagem</h3>
                  </div>
                  <p class="small m-0 text-muted">Exibindo {{count($items)}} de {{$paginator['total']}} resultados</p>
              </div>
          </div>

          @if ($search)
            <div class="card-header p-0">
                <form method="get">
                    <div class="row m-0">
                        <div class="col p-0">
                            <input type="search" name="search" class="form-control" style="border-radius: 0;" placeholder="Pesquise aqui...." value="{{Request::query('search')}}" />
                        </div>
                        <button type="submit" class="btn btn-success p-2 px-3" style="border-radius: 0;">
                            <i class="material-icons text-white pt-1" style="font-size: 18px;">search</i>
                        </button>
                    </div>
                </form>
            </div>
          @endif
          @if (count($items) > 0)
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        @if ($sortable && empty(Request::query('search')))
                            <th style="width: 48px;">
                                <i class="material-icons">sort</i>
                            </th>
                        @endif
                        @foreach ($table as $column)
                            <th @if (isset($column['size'])) width="{{$column['size']}}" @endif>
                                {{$column['label']}}
                            </th>
                        @endforeach
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($items as $item)
                        <tr data-id="{{$item['id']}}" class="{{isset($item['active']) && !$item['active'] ? 'table-danger' : ''}}">
                            @if ($sortable && empty(Request::query('search')))
                                <th style="width: 48px;">
                                    <i class="material-icons">swap_vert</i>
                                </th>
                            @endif
                            @foreach ($table as $column)
                                <td>
                                    @php
                                        if(is_array($column['name'])){
                                            $value = $item;
                                            foreach($column['name'] as $name){
                                                $value = $value[$name] ?? '';
                                            }
                                        }else{
                                            $value = $item[$column['name']];
                                        }
                                    @endphp
                                    @if(isset($column['type']) && $column['type'] == 'image')
                                        <img src="{{ resize($value, ($column['size'] ?? 100))}}" style="max-width: 100%;height:50px; object-fit:cover" />
                                    @endif
                                    @if(isset($column['count']))
                                        {{count($item[$column['count']])}}
                                    @endif
                                    @if(!isset($column['type']) || $column['type'] == 'text')
                                        {!! mb_strimwidth( strip_tags($value),0,100,'...') !!}
                                    @endif
                                </td>
                            @endforeach
                            <td class="text-right">
                                @if($view)
                                    <a class="btn btn-success btn-sm" href="{{ route(Route::currentRouteName().'.view', ['id' => $item['id'], 'fk' => Request::route('fk')])}}">
                                        <i class="material-icons text-white" style="font-size: 15px;">visibility</i>
                                    </a>
                                @endif
                                @if($edit)
                                    <a class="btn btn-primary btn-sm" href="{{ route(Route::currentRouteName().'.edit', ['id' => $item['id'], 'fk' => Request::route('fk')])}}">
                                        <i class="material-icons text-white" style="font-size: 15px;">edit</i>
                                    </a>
                                @endif
                                @if ($delete)
                                    <form style="display: inline;"
                                        onsubmit="return confirm('Deseja realmente excluir o registro?')"
                                        action="{{route(Route::currentRouteName().'.delete', ['id' => $item['id'], 'fk' => Request::route('fk')])}}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="material-icons text-white" style="font-size: 15px;">delete</i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
          @else

          <div class="card-body text-center">
            <div class="m-4">
                <i class="material-icons" style="font-size: 50px;">bookmark_border</i>
                <h3>Nenhum item a ser exibido!</h3>
            </div>
          </div>

          @endif

          @if(($pagination && !$sortable) || $export)
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        @if($export)
                            <a href="{{route(Route::currentRouteName().'.export', ['search' => Request::query('search'), 'fk' => Request::route('fk')])}}" class="btn btn-success btn-sm text-white">
                                <div class="row m-0 align-items-center">
                                    <div class="col p-0">
                                        Exportar
                                    </div>
                                    <i class="material-icons text-white">cloud_download</i>
                                </div>
                            </a>
                        @endif
                    </div>

                    @if($pagination && !$sortable)
                        <nav>
                            <ul class="pagination m-0 mx-3">

                                @if($paginator['page'] > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{route(Route::currentRouteName(),['page' => $paginator['page'] - 1, 'search' => Request::query('search'), 'fk' => Request::route('fk')])}}">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @for($i=(($paginator['page']-3) > 0 ? $paginator['page']-3 : 1); $i < $paginator['page']; $i++)
                                    <li class="page-item">
                                        <a class="page-link" href="{{route(Route::currentRouteName(),['page' => $i, 'search' => Request::query('search'), 'fk' => Request::route('fk')])}}"">{{$i}}</a>
                                    </li>
                                @endfor

                                <li class="page-item active"><a class="page-link">{{$paginator['page']}}</a></li>

                                @for($i=$paginator['page']+1; $i <= $paginator['pages'] && $i < $paginator['page'] + 4; $i++)
                                    <li class="page-item">
                                        <a class="page-link" href="{{route(Route::currentRouteName(),['page' => $i, 'search' => Request::query('search'), 'fk' => Request::route('fk')])}}">{{$i}}</a>
                                    </li>
                                @endfor

                                @if($paginator['page'] < $paginator['pages'])
                                    <li class="page-item">
                                        <a class="page-link" href="{{route(Route::currentRouteName(),['page' => $paginator['page'] + 1, 'search' => Request::query('search'), 'fk' => Request::route('fk')])}}">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>

    @if ($sortable && empty(Request::query('search')))
    <script type="text/javascript">
        $(function(){
            $('tbody').sortable({
                update: function(event){
                    const order = [];
                    $('tbody.list tr').each((index, element) => {
                        order.push($(element).attr('data-id'));
                    });
                    $.post('{{route(Route::currentRouteName().'.sort', ['fk' => Request::route('fk')])}}', {
                        'order' : order ,
                        '_token' : $("meta[name='csrf-token']").attr("content")
                    }, (res) => {

                    }, "json");
                }
            });
        });
    </script>
    @endif
@endsection
