@extends('cms::layouts.module')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/cms"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ $currentModule->getUrl() }}"><i class="{{ $currentModule->getIcon() }}"></i> {{ $currentModule->getTitle() }}</a></li>
        <li class="active"><i class="fa fa-edit"></i> {{ $currentModule->getEditingText() }} #{{ $promotion->getId() }}</li>
    </ol>
@endsection

@section('module.content')

    <section class="content">
        <div class="row">

            {!! Form::model($promotion, ['route' => ['cms.' . $currentModule->getName() . '.edit#update', $promotion->getId()], 'method' => 'PUT', 'files' => true]) !!}

            <div class="col-xs-12 col-lg-9">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $currentModule->getEditingText() }} #{{ $promotion->getId() }}</h3>
                            </div>

                            {!! Form::hidden('id', $promotion->getId()) !!}

                            <div class="box-body">
                                @include('cms::promotions.discount.form')
                            </div>
                        </div>
                    </div>
                </div>
                <activity-logs activity-logs="{{ $promotion->lastLogs()->toJson() }}"></activity-logs>
            </div>

            <div class="col-xs-12 col-lg-3">
                <div class="row">
                    <div class="col-xs-12">
                        @section('destroy-button')
                            <button type="submit" class="btn btn-danger btn-block" name="status" value="2"><i class="fa fa-ban"></i> Encerrar</button>
                        @endsection
                        @include('cms::layouts.partials.publication.edit.default', ['model' => $promotion])
                    </div>

                    @if ($promotion->hasSealImage())
                        <div class="col-xs-12">
                            @include('cms::layouts.partials.image.default', [
                            'box_title' => 'Selo da promoção',
                            'image' => $promotion->getSealImage(),
                            'delete_url' => route('cms.discount-promotion.edit#remove-seal', [$promotion->getId()])
                            ])
                        </div>
                    @endif

                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </section>

@endsection

@section('scripts')
    @parent
    
    <script type="text/javascript">

        function reloadTable() {
            var $table = $('.table');
            $table.DataTable().ajax.reload();
        }

        $(function() {
            
            var $containerExchangeRate = $('#containerExchangeRate');
            var $containerDiscountValue = $('#containerDiscountValue');
            
            $('#frmDiscountType').bind('change', function () {
                
                var $self = $(this);
                var value = $self.val();
                
                if (value == 'exchange-rate') {
                    
                    $containerDiscountValue.hide().find('input').val('');
                    $containerExchangeRate.show();
                    
                } else {
                    
                    $containerExchangeRate.hide().find('input').val('');
                    $containerDiscountValue.show();
                }
                
            }).change();
            
            $('body').delegate('[data-remove-item]', 'click', function(e) {
                
                var $self = $(this);
                
                function submitForm()
                {
                    var method = $self.data('method');
                    var action = $self.data('action');
                    
                    $.ajax({
                        type: method,
                        url: action,
                        dataType: 'json',
                        success: function(response) {
                            
                            reloadTable();
                            
                            swal('Pronto!', response.message, 'success');
                            
                        },
                        error: function(response) {
                            
                            swal('Ops!', response.message, 'error');
                            
                        }
                    });
                    
                    return true;
                }
                
                var confirmTitle = $self.data('confirm-title');
                var confirmText = $self.data('confirm-text');
                
                if (typeof confirmTitle !== typeof undefined && confirmTitle !== false) {
                    
                    swal({
                        title: confirmTitle,
                        text: confirmText,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Sim",
                        cancelButtonText: "Não",
                        closeOnConfirm: false
                    }, function() {
                        
                        submitForm();
                        
                    });
                    
                }
                
                e.preventDefault();
            });
            
        });
    
    </script>

@endsection