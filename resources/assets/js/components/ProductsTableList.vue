<template>
    <div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-sm-12">
                <div class="btn-group pull-right">
                    <button class="btn btn-warning" @click.prevent="removeSelected()"><i class="fa fa-trash"></i> Remover selecionados</button>
                    <button class="btn btn-danger" @click.prevent="removeAll()"><i class="fa fa-trash"></i> Remover todos</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped"
                   :data-url="dataUrl">
                <thead>
                <tr>
                    <th>#SKU</th>
                    <th><i class="fa fa-pencil"></i> Título</th>
                    <th v-if="hasOrderUrl()"><i class="fa fa-list-ol"></i> Ordem</th>
                    <th><i class="fa fa-cubes"></i> Estoque</th>
                    <th><i class="fa fa-calendar"></i> Adicinado em</th>
                    <th>Ações</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</template>
<script type="text/javascript">
    export default{
        props: {
            resourceId: {
                required: true
            },
            resourceType: {
                required: true
            },
            dataUrl: {
                required: true
            },
            deleteSelectedUrl: {
                required: false
            },
            deleteAllUrl: {
                required: false
            },
            updatePositionUrl: {
                required: false
            }
        },
        mounted() {
            let self = this;
            let $table = $('.table');

            $table.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: $table.data('url'),
                    type: "POST",
                    data: function (data) {

                        data.resource = {
                            id: self.resourceId,
                            type: self.resourceType
                        };

                    }
                },
                drawCallback: function (settings) {
                    $table.find('.field-editable').each(function (i, el) {

                        var $el = $(el);
                        var itemId = $el.attr('data-id');

                        $el.editable("click", function (e) {

                            self.$http.post(
                                    self.updatePositionUrlComputed(itemId),
                                {position: e.value}
                            ).then(function (response) {
                                self.reloadTable();
                            });

                        });

                    });

                },
                searchDelay: 600,
                order: [[2, "asc"]],
                columnDefs: [
                    {orderable: false, width: '92px', targets: -1},
                    {className: 'hcenter vcenter', width: '50px', targets: 0},
                    {className: 'hcenter vcenter', width: '70px', targets: [2, 3]},
                    {className: 'vcenter', targets: [1, 2, 3]}
                ]
            });

            bus.$on('productsAdded', function () {
                self.reloadTable();
            });
        },
        methods: {
            hasOrderUrl() {
                return this.updatePositionUrl !== undefined;
            },
            reloadTable() {
                let $table = $('.table');
                $table.DataTable().ajax.reload();
            },
            removeSelected() {

                if (this.deleteSelectedUrl == 'undefined') {
                    swal('É necessário fornecer uma URL para deletar os produtos selecionados!', '', 'info');
                    return false;
                }

                let self = this;

                swal({
                    title: 'Confirmação de exclusão',
                    text: 'Tem certeza que deseja remover os produtos selecionados?',
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não",
                    closeOnConfirm: false
                }, function() {
                    let selected = [];

                    $.each($("input[type='checkbox'].line-item:checked"), function (index, el) {
                        selected[index] = $(this).val();
                    });

                    self.$http.post(
                            self.deleteSelectedUrl,
                            {items: selected}
                    ).then(function (response) {
                        swal(response.data.message, '', 'info');
                        self.reloadTable();
                    });
                });
            },
            removeAll() {

                if (this.deleteAllUrl == 'undefined') {
                    swal('É necessário fornecer uma URL para deletar todos os produtos!', '', 'info');
                    return false;
                }

                let self = this;

                swal({
                    title: 'Confirmação de exclusão',
                    text: 'Tem certeza que deseja remover <b>todos</b> os produtos?',
                    html: true,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não",
                    closeOnConfirm: false
                }, function() {
                    self.$http.post(
                        self.deleteAllUrl
                    ).then(function (response) {
                        swal(response.data.message, '', 'info');
                        self.reloadTable();
                    });
                });
            },
            updatePositionUrlComputed(itemId) {
                return this.updatePositionUrl + '/' + itemId;
            }
        }
    }
</script>
