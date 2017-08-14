<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Publicação</h3>
    </div>
    <div class="box-body">
        <button type="submit" class="btn btn-success btn-block" name="status" value="1"><i class="fa fa-check"></i> Salvar e publicar</button>
        @if(isset($hasDraft) && $hasDraft)
            <button type="submit" class="btn btn-primary btn-block" name="status" value="0"><i class="fa fa-edit"></i> Salvar como rascunho</button>
        @endif
    </div>
</div>