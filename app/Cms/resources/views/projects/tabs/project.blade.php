<div class="tab-pane {{ currentTabActive('#tabData', 'active', true) }}" id="tabData">
    <input type="hidden" name="channel" value="1">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="form-group">
                <label for="txtShowcaseTitle">Título</label>
                {!! Form::text('title', null, ['id' => 'txtShowcaseTitle', 'class' => 'form-control', 'placeholder' => 'Digite o título']) !!}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12">
            <div class="form-group">
                <label for="txtShowcaseTitle">Sub título</label>
                {!! Form::text('subtitle', null, ['id' => 'txtShowcaseTitle', 'class' => 'form-control', 'placeholder' => 'Digite o título']) !!}
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="form-group">
                <label for="txtShowcaseDescription">Descrição</label>
                {!! Form::textarea('description', null, ['id' => 'txtShowcaseDescription', 'class' => 'form-control html-editor', 'placeholder' => 'Digite a descrição', 'rows' => '10']) !!}
            </div>
        </div>
    
        <div class="col-lg-12">
            <div class="form-group">
                <label for="banner">Banner do Projeto</label>
                {!! Form::file('banner', ['id' => 'banner']) !!}
            </div>
        </div>
    </div>
</div>