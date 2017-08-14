@extends('cms::layouts.module')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/cms"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ $currentModule->getUrl() }}"><i class="{{ $currentModule->getIcon() }}"></i> {{ $currentModule->getTitle() }}</a></li>
        <li class="active"><i class="fa fa-edit"></i> {{ $currentModule->getEditingText() }} #{{ $project->getId() }}</li>
    </ol>
@endsection

@section('module.content')

    <section class="content">
        <div class="row">

            {!! Form::model($project, ['route' => ['cms.' . $currentModule->getName() . '.edit#update', $project->getId()], 'method' => 'PUT', 'files' => true]) !!}

            <div class="col-xs-12 col-lg-9">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $currentModule->getEditingText() }} #{{ $project->getId() }}</h3>
                            </div>

                            {!! Form::hidden('id', $project->getId()) !!}

                            <div class="box-body">
                                @include('cms::projects.form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-lg-3">
                <div class="row">
                    <div class="col-xs-12">
                        @section('destroy-button')
                            <button type="submit" class="btn btn-danger btn-block" name="status" value="2"><i class="fa fa-ban"></i> Encerrar</button>
                        @endsection
                        @include('cms::layouts.partials.publication.edit.default', ['model' => $project])
                    </div>
    
                    @if ($project->hasBanner())
                        <div class="col-xs-12">
                            @include('cms::layouts.partials.image.default', [
                            'box_title' => 'Selo da promoção',
                            'image' => $project->getBanner(),
                            'delete_url' => route('cms.projects.edit#remove-banner', [$project->getId()])
                            ])
                        </div>
                    @endif
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </section>

@endsection