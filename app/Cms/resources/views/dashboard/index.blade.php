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
                <div class="col-lg-3 col-xs-6">
                    <a href="{{ route('cms.projects.list') }}" class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $numberOfProjects }}</h3>
                            <p>Projetos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <label class="small-box-footer" style="cursor:pointer;">
                            Mais informações <i class="fa fa-arrow-circle-right"></i>
                        </label>
                    </a>
                </div>
            </section>
            <section class="col-lg-12">
                <div class="row">
                    <div id="left-column" class="col-lg-7">
                    
                    </div>
                    <div id="right-column" class="col-lg-5">
                    
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