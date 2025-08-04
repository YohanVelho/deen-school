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
            @if(!$unique)
                <a href="{{url()->previous()}}" class="btn">
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

          <div class="col text-right">
            @foreach ($actions as $action)
                <a href="{{$action['route']}}" class="btn btn-secondary">
                    @if (isset($action['icon']))
                        <span class="btn-inner--icon">
                            <i class="material-icons float-left mr-2" style="font-size: 18px;">{{$action['icon']}}</i>
                        </span>
                    @endif
                    <span class="btn-inner--text">{{$action['label']}}</span>
                </a>
            @endforeach
          </div>
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
    <form method="post" id="form" enctype="multipart/form-data" action="">
        @csrf

        @if ($translate)
            @php
                $languages = \App\Models\LanguageModel::where('active', 1)->orderBy('position')->get()->toArray();
            @endphp
            <div class="nav-wrapper" style="position: relative;">
                <ul class="nav nav-pills" id="tabs-icons-text">
                    @foreach ($languages as $i => $lang)
                        <li class="nav-item">
                            <a class="nav-link js-lang-tab {{ $i == 0 ? "active" : ""}}" data-select-lang="{{ strtolower($lang['slug']) }}">
                                {{$lang['name']}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif


        @foreach($form as $card)
            <div class="card mb-4">
                @if(isset($card['title']))
                    <div class="card-header">
                        @if (isset($card['icon']))
                            <i class="material-icons float-left mr-2">{{$card['icon']}}</i>
                        @endif
                        <h3 class="mb-0">{{$card['title']}}</h3>
                        @if (isset($card['active']))
                            <div class="float-right">
                                <label class="switch switch-card">
                                    <input type="hidden" name="{{$card['active']}}" value="0" />
                                    <input type="checkbox" name="{{$card['active']}}" value="1" {{ old($card['active'], $value[$card['active']] ?? 1)  ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="card-body">
                    <div class="row">
                        @foreach ($card['inputs'] as $input)
                            @if (isset($input['translate']) && $input['translate'] && $translate)
                                @foreach ($languages as $i => $lang)
                                    @php
                                        $input['lang'] = $lang['slug'];
                                    @endphp
                                    @include('admin.pages.generic.inputs.'.($input['input'] ?? 'input'), [
                                        'input' => $input
                                    ])
                                @endforeach
                            @else
                                @include('admin.pages.generic.inputs.'.($input['input'] ?? 'input'), [
                                    'input' => $input
                                ])
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($tabs))
            <div class="nav-wrapper" style="position: relative;">
                <ul class="nav nav-pills" id="tabs-icons-text">
                    @foreach($tabs as $key => $tab)
                        <li class="nav-item">
                            <a class="nav-link {{!$key ? 'active' : ''}}" data-toggle="tab" href="#tab-{{preg_replace("/[^a-zA-Z0-9]+/", "", $tab['title'])}}">
                                @if (isset($tab['icon']))
                                    <i class="material-icons float-left mr-2">{{$tab['icon']}}</i>
                                @endif
                                {{$tab['title']}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @foreach($tabs as $key => $tab)
                <div class="tab-pane fade {{!$key ? 'show active' : ''}}" id="tab-{{preg_replace("/[^a-zA-Z0-9]+/", "", $tab['title'])}}">
                    @foreach($tab['form'] as $card)
                        <div class="card mb-4">
                            @if(isset($card['title']))
                                <div class="card-header">
                                    @if (isset($card['icon']))
                                        <i class="material-icons float-left mr-2">{{$card['icon']}}</i>
                                    @endif
                                    <h3 class="mb-0">{{$card['title']}}</h3>
                                    @if (isset($card['active']))
                                        <div class="float-right">
                                            <label class="switch switch-card">
                                                <input type="hidden" name="{{$card['active']}}" value="0" />
                                                <input type="checkbox" name="{{$card['active']}}" value="1" {{ old($card['active'], $value[$card['active']] ?? 1)  ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($card['inputs'] as $input)
                                        @if (isset($input['translate']) && $input['translate'] && $translate)
                                            @foreach ($languages as $i => $lang)
                                                @php
                                                    $input['lang'] = $lang['slug'];
                                                @endphp
                                                @include('admin.pages.generic.inputs.'.($input['input'] ?? 'input'), [
                                                    'input' => $input
                                                ])
                                            @endforeach
                                        @else
                                            @include('admin.pages.generic.inputs.'.($input['input'] ?? 'input'), [
                                                'input' => $input
                                            ])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif

        <div class="row mb-4">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-success">
                    <i class="material-icons float-left mr-2 text-white" style="font-size: 18px;">save</i>
                    SALVAR
                </button>
            </div>
        </div>
    </form>
  </div>
@endsection
