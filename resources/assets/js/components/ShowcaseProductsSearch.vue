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
        props: ['showcaseId', 'filtersEndpoint', 'basePath'],
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

                this.$http.post(
                        '/cms/showcases/home-showcases/' + this.showcaseId + '/items',
                        {showcaseId: this.showcaseId, products: products}
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
