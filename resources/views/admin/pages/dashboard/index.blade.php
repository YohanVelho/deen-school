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
                <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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

            <div class="row align-items-center">
                <div class="col">
                    <h2 class="m-0"><span class="small">Olá, </span> {{session('user')['name']}}</h2>
                    <p class="small text-muted m-0">{{session('user')['email']}}</p>
                </div>
                <div class="mr-3">
                    <a href="{{ route('admin.login.logout') }}" class="btn btn-sm btn-danger text-white">
                        <div class="row align-items-center m-0">
                            <i class="material-icons text-white">exit_to_app</i>
                            <div class="col p-0">
                                Sair
                            </div>
                        </div>
                    </a>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body text-center">
                <img class="my-5" src="{{asset('assets/admin/images/banner.jpg')}}" />
            </div>
          </div>
        </div>
    </div>


  </div>

@endsection
