<template>
    <div>
        <discount-groups-editor
                :filters-endpoint="filtersEndpoint"
                :base-path="basePath"
                :data="discountData"
                v-on:save="save"></discount-groups-editor>
    </div>
</template>
<script type="text/javascript">

    import DiscountGroupsEditor from './corporate/DiscountGroupsEditor.vue'

    export default {
        components: {
            DiscountGroupsEditor
        },

        props: {
            filtersEndpoint: {
                type: String
            },
            basePath: {
                type: String
            },
            data: {
            },
            routeToSaveProducts: {
                type: String
            }
        },

        data() {
            return {
                discountData: []
            }
        },

        created() {
            this.discountData = this.data;
        },

        methods: {

            save(data) {
                this.$http.post(this.routeToSaveProducts, {data}).then(() => {
                    swal('Pronto!', 'Produtos salvos com sucesso!', 'success');
                });
            }

        }
    }
</script>
