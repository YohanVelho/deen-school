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
            <h2 class="h2 text-white d-inline-block mb-0">{{$title}}</h2>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid mt--6">
    @foreach($view as $card)
        <div class="card mb-4">
            <div class="card-header">
                @if (isset($card['icon']))
                    <i class="material-icons float-left mr-2">{{$card['icon']}}</i>
                @endif
                <h3 class="mb-0">{{$card['title']}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($card['inputs'] as $input)
                        <div class="col-{{$input['size'] ?? 12}}">
                            <div class="form-group">
                                <label class="form-control-label">{{$input['label']}}</label>
                                <p>{{$value[$input['name']]}}</p>
                                @if(isset($input['hint']))
                                    <p class="small text-muted">{{$input['hint']}}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
  </div>

@endsection
