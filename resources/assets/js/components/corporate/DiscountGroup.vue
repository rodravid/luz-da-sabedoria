<template>
    <div>
        <div class="box" :class="{'collapsed-box': collapsed}" style="border-top: 0; margin-bottom: 0;">
            <div class="box-header" style="background: #d6d5d1;">
                <div class="row">
                    <div class="col-lg-3" style="height: 34px;">
                        <div class="input-group input-group-sm" style="display: flex; align-items: center;justify-content: center;height: 34px;">
                            <label><input type="radio" v-model="discount_type" value="percent"> Porcentagem</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><input type="radio" v-model="discount_type" value="fixed"> Fixo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><input type="radio" v-model="discount_type" value="exchange-rate"> Dólar</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="col-lg-5 col-lg-offset-1" style="height: 34px;">
                        <div class="form-group" style="display: flex; align-items: center;justify-content: center;height: 34px;">
                            <label for="txtShowcaseTitle">Valor do desconto</label>
                            <input id="txtShowcaseTitle" type="text" v-model="discount_amount" class="form-control" placeholder="Valor do desconto">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-default" @click="$emit('remove')"><i class="fa fa-remove text-danger"></i> Remover</button>
                            <button type="button" class="btn btn-default" data-widget="collapse"><i class="fa" :class="{'fa-plus': collapsed, 'fa-minus': !collapsed}"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body" style="background: #f7f6ed;">
                <div class="row">
                    <div class="col-lg-8">
                        <products-search
                                v-on:searched="addProducts"
                                :filters-endpoint="filtersEndpoint"
                                :base-path="basePath"></products-search>
                    </div>
                    <div class="col-lg-4">
                        <div class="well" style="height: 70px;">
                            <div class="form-group" style="display: flex; align-items: center;justify-content: center;height: 34px;">
                                <label for="txtSearchProduct">Buscar produto:</label>
                                <input id="txtSearchProduct" type="text" v-model="keyword" class="form-control" placeholder="Pesquise o produto desejado">
                            </div>
                        </div>
                        <div class="well" style="height: 562px;overflow: auto;">
                            <div v-if="products.length == 0 || ! keywordMatches" style="display: flex; align-items: center;justify-content: center;height: 100%;">
                                <h3>Nenhum produto encontrado</h3>
                            </div>
                            <ul class="list-group" v-else>
                                <li class="list-group-item" v-for="(product, index) in products" style="padding: 20px 10px;" v-if="product.title.indexOf(keyword) !== -1">
                                    <div class="row">
                                        <div class="col-lg-8"><strong>{{ product.title }}</strong></div>
                                        <div class="col-lg-4">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-default" @click="products.splice(index, 1)"><i class="fa fa-remove text-danger"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import ProductsSearch from '../productsSearch.vue';

    export default {
        components: {
            ProductsSearch
        },

        props: {
            filtersEndpoint: {
                type: String
            },
            basePath: {
                type: String
            },
            discountGroup: {
                type: Object
            },
            isCollapsed: {
                type: Boolean,
                default: true,
            },
        },
        data: function () {
            return {
                collapsed: this.isCollapsed,
                keyword: '',
                ...this.discountGroup
            }
        },
        computed: {
            keywordMatches() {
                return this.products.filter((product) => {
                    if (product.title.indexOf(this.keyword) !== -1) {
                        return product;
                    }
                }).length > 0;
            }
        },
        methods: {
            addProducts(products) {
                products.map((product) => {
                    this.products.push(product);
                });

                swal({
                    title: "Pronto!",
                    text: "Produtos selecionados com sucesso! Salva para persistir as mudanças",
                    type: 'success',
                    html: true
                });
            },
            getDiscountSpecification() {
                return {
                    discount_type: this.discount_type,
                    discount_amount: this.discount_amount,
                    products: this.products,
                    collapsed: this.collapsed
                }
            }
        }
    }
</script>