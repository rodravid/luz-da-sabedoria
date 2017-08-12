<div class="col-lg-12">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-7 mgTop15">
            <label>Link de Redirecionamento</label>
            {!! Form::text('redirect_url', null, ['class' => 'form-control', 'placeholder' => 'Ex.: http://']) !!}
        </div>
        <div class="col-xs-12 col-md-12 col-lg-5 mgTop15">
            <label>Tipo de redirecionamento</label>
            <div class="flat-green">
                <input type="radio" id="redirect_301" name="redirect_type" value="301"
                       @if (isset($model) && $model->getRedirectType() == 301) checked="checked" @endif>
                <label for="redirect_301">301 <small class="text-blue">(Moved Permanently)</small></label>
                <br>
                <input type="radio" id="redirect_302" name="redirect_type" value="302"
                       @if (isset($model) && ($model->getRedirectType() == 302 || empty($model->getRedirectType()))) checked="checked" @endif>
                <label for="redirect_302">302 <small class="text-green">(Moved Temporarily)</small></label>
            </div>
        </div>
    </div>
</div>