@extends('cms::layouts.master')

@section('content')

    <section class="content-header">
        <h1>Dashboard<small>Painel de Controle</small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('cms.dashboard.show') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section id="app" class="content">
        <div class="row">
        </div>
        <div class="row">
            <section class="col-lg-12">
            
            </section>
            <section class="col-lg-12">
                <div class="row">
                    <div id="left-column" class="col-lg-7 connectedSortable">
                    </div>
                    <div id="right-column" class="col-lg-5 connectedSortable">
                    
                    </div>
                </div>
            </section>
        </div>
    </section>

@endsection

@section('scripts')
    @parent

{{--    <script src="{{ asset_cms('dist/js/pages/dashboard.js') }}"></script>--}}

@endsection