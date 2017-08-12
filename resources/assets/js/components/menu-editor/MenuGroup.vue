<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="box" :class="{'collapsed-box': collapsed}" style="border-top: 0; margin-bottom: 0;">
                <div class="box-header" style="background: #d6d5d1;">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-edit"></i> Título do menu</div>
                                <input type="text" class="form-control" v-model="title" placeholder="Digite o título do menu">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-link"></i> Link do menu</div>
                                <input type="text" class="form-control" v-model="url" placeholder="Digite o link do menu">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-paint-brush"></i> Cor do template</div>
                                <select class="form-control" v-model="template">
                                    <option value="template1">Azul</option>
                                    <option value="template2">Vermelho</option>
                                    <option value="template3">Verde</option>
                                    <option value="template4">Roxo</option>
                                    <option value="template5">Pink</option>
                                    <option value="template6">Azul Escuro</option>
                                    <option value="template7">Laranja</option>
                                    <option value="template8">Preto</option>
                                    <option value="template9">Laranja escuro</option>
                                    <option value="template10">Dark Pink</option>
                                    <option value="template11">Pink light</option>
                                    <option value="template12">Roxo light</option>
                                    <option value="template13">Cinza</option>
                                    <option value="template14">Amarelo</option>
                                    <option value="template15">Vermelho escuro</option>
                                    <option value="template16">Rosa Light</option>
                                    <option value="template17">Marrom Light</option>
                                    <option value="template18">Rosa Dark</option>
                                    <option value="template19">Azul Claro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-sort" title="Clique e arraste para ordenar"><i class="fa fa-arrows"></i></button>
                                <button type="button" class="btn btn-default" @click="$emit('remove')"><i class="fa fa-remove text-danger"></i> Remover</button>
                                <button type="button" class="btn btn-default" data-widget="collapse"><i class="fa" :class="{'fa-plus': collapsed, 'fa-minus': !collapsed}"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body" style="background: #f7f6ed;">
                    <div class="row">
                        <div class="col-lg-4" v-for="(col, index) in columns">
                            <div class="">
                                <div class="box-header">
                                    <div class="row">
                                        <div style="width: 100%; height: 40px; background: #d6d5d1; display: flex; align-items: center; justify-content: center;"><b>COLUNA {{ index + 1 }}</b></div>
                                        <div class="col-lg-12">
                                            <div class="input-group input-group-sm" style="display: flex; align-items: center; justify-content: center;">
                                                <div>
                                                    <div class="radio">
                                                        <label :for="elementId('radioList' + index)"><input type="radio" v-model="col.type" value="list" :id="elementId('radioList' + index)">Lista</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label :for="elementId('radioLink' + index)"><input type="radio" v-model="col.type" value="unique-link" :id="elementId('radioLink' + index)">Link único</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label :for="elementId('radioProduct' + index)"><input type="radio" v-model="col.type" value="product" :id="elementId('radioProduct' + index)">Produto</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body" style="background: #eae9e3;">
                                    <component :is="col.type" :data="col.data" ref="columns" :index="col.index"></component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">

    import List from './types/list/List.vue'
    import UniqueLink from './types/link/Link.vue'
    import Product from './types/product/Product.vue'

    export default {
        components: {
            List,
            UniqueLink,
            Product
        },
        props: {
            isCollapsed: {
                type: Boolean,
                default: true,
            },
            data: {
                type: Object,
                default: function () {
                    return {
                        title: '',
                        url: '',
                        template: 'template1',
                        columns: []
                    };
                }
            }
        },
        data() {
            return {
                collapsed: this.isCollapsed,
                ...this.data
            };
        },

        created() {

            this.columns = this.data.columns.map((col, index) => {
                col.index = index;
                return col;
            });

        },

        methods: {
            elementId(text) {
                return `input${this.title.trim()}-${text}`;
            },

            getData() {

                let columns = this.$refs.columns.sort((a ,b) => {
                    if (a.index < b.index)
                        return -1;
                    if (a.index > b.index)
                        return 1;
                    return 0;
                }).map((col) => {
                    return col.getData();
                });

                return {
                    title: this.title,
                    url: this.url,
                    template: this.template,
                    columns
                };

            }

        }
    }
</script>
