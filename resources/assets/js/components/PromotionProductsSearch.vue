<template>
    <div>
        <products-search
                v-on:searched="addProducts"
                :filters-endpoint="filtersEndpoint"
                :base-path="basePath"></products-search>
    </div>
</template>
<script type="text/javascript">
    export default{
        props: ['promotionId', 'currentModuleName', 'filtersEndpoint', 'basePath'],
        methods: {
            addProducts: function (products) {
                if (products == null) {
                    swal('', 'Nenhum produto foi selecionado.', 'info');
                    return false;
                }

                swal({
                    title: "Adicionando produtos...<br /><center><img src='/assets/cms/dist/img/loading.gif' align='center' style='margin-top: 20px;'></center>",
                    text: "Por favor aguarde, isso pode levar alguns minutos.",
                    html: true,
                    showConfirmButton: false
                });

                var promotion_id = this.promotionId;
                var currentModuleName = this.currentModuleName;

                this.$http.post(
                        '/cms/promotions/' + currentModuleName + '/' + promotion_id + '/items/add',
                        {id: promotion_id, products: products}
                ).then(function (response) {
                    if (!response.error) {
                        swal({
                            title: "Pronto!",
                            text: "Produtos adicionados com sucesso!",
                            type: 'success',
                            html: true
                        });
                    } else {
                        swal({
                            title: "Ops!",
                            text: "Ocorreu um erro ao adicionar os produtos!",
                            type: 'error',
                            html: true
                        });
                    }

                    bus.$emit('productsAdded');
                });
            }
        }
    }

</script>
