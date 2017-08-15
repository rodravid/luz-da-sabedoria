<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Publicação</h3>
    </div>
    <div class="box-body">

        @if($model->hasProperty('status'))
            <p><b>Status:</b> {!! present_status_html($model->getStatus()) !!}</p>
        @endif

        <p><i class="fa fa-calendar"></i><b> Criado em:</b> {{ $model->getCreatedAt()->format('d/m/Y \à\s H:i\h') }}</p>
        <p><i class="fa fa-calendar"></i><b> Última atualização:</b> {{ $model->getUpdatedAt()->format('d/m/Y \à\s H:i\h') }}</p>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-success btn-block" name="status" value="1"><i class="fa fa-check"></i> Salvar e publicar</button>
        @if($model->hasProperty('status') && ! isset($hideDraft))
            <button type="submit" class="btn btn-primary btn-block" name="status" value="0"><i class="fa fa-edit"></i> Salvar como rascunho</button>
        @endif
        @if(cmsUser()->hasPermissionTo('cms.' . $currentModule->getName() . '.destroy'))
            @section('destroy-button')
                <a href="javascript:void(0);" class="btn btn-danger btn-block"
                   data-form-link
                   data-confirm-title="Confirmação de exclusão"
                   data-confirm-text="Deseja realmente excluir esse registro?"
                   data-method="DELETE"
                   data-action="/{{ Route::current()->getPrefix() }}/{{ $model->getId() }}/delete"><i class="fa fa-trash"></i> Excluir</a>
            @show
        @endif
    </div>
</div>