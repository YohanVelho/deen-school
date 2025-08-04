@extends('admin.master.admin')

@section('layout')
    @include('admin.components.sidebar')

    <div class="main-content" id="panel">

        @yield('content')

    </div>
@endsection
