<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">

      <div class="sidenav-header align-items-center">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{asset('assets/admin/images/logo.png')}}" height="25" class="navbar-brand-img" alt="...">
        </a>
        <a class="mobile-close  d-xl-none" href="javascript:void(0);">
            X
        </a>
      </div>

      <div class="navbar-inner">
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item mb-3">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i> Dashboard
                </a>
            </li>

            @php
                use \App\Models\ModulesModel;
                use \App\Models\UserModel;


                $modules = ModulesModel::where('active', 1)
                                        ->whereNull('parent')
                                        ->where('action', 0)
                                        ->with('children')
                                        ->orderBy('position')
                                        ->get()->toArray();

                $user = UserModel::where('id', session('user')['id'])->first()->toArray();
                $permissions = json_decode($user['permissions'], true) ?? [];
            @endphp

            @foreach ($modules as $module)

                @php
                    if(count($module['children']) > 0){
                        foreach($module['children'] as $index => $child){
                            if(!in_array($child['id'], $permissions)){
                                unset($module['children'][$index]);
                            }
                        }
                    }
                @endphp

                @if(in_array($module['id'], $permissions) || count($module['children']) > 0)
                    @if (!count($module['children']) && $module['crud'])
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.'.$module['url']) }}">
                                <i class="material-icons">{{$module['icon']}}</i> {{$module['name']}}
                            </a>
                        </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link js-open-collapse">
                            <i class="material-icons">{{$module['icon']}}</i>
                            {{$module['name']}}
                            <i class="material-icons arrow">expand_more</i>
                        </a>
                        <div class="collapse" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    @foreach ($module['children'] as $child)
                                        <a class="nav-link" href="{{ route('admin.'.$child['url']) }}">
                                            <i class="material-icons">{{$child['icon']}}</i> {{$child['name']}}
                                        </a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                @endif
            @endforeach

            <li class="nav-item mt-3">
                <a class="nav-link" href="{{ route('admin.login.logout') }}">
                    <i class="material-icons">exit_to_app</i> Sair
                </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
