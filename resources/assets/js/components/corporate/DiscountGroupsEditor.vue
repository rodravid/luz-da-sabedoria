<template>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-group" id="discountGroupsList">
                        <li class="list-group-item" v-for="(discountGroup, index) in discountGroups" style="padding: 20px 10px;">
                            <discount-group
                                    :discountGroup="discountGroup"
                                    v-on:remove="discountGroups.splice(index, 1)"
                                    :is-collapsed="discountGroup.collapsed"
                                    :filters-endpoint="filtersEndpoint"
                                    :base-path="basePath"
                                    ref="groups"></discount-group>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <button type="button" class="btn btn-success" @click="save"><i class="fa fa-plus-circle"></i> Salvar e publicar</button>
                    <button type="button" class="btn btn-default" @click="addGroup"><i class="fa fa-plus-circle text-success"></i> Adicionar grupo</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">

    import DiscountGroup from './DiscountGroup.vue'

    export default {
        components: {
            DiscountGroup
        },
        props: {
            filtersEndpoint: {
                type: String
            },
            basePath: {
                type: String
            },
            data: {
                type: Array,
                default: function() {
                    return [];
                }
            }
        },
        data() {
            return {
                discountGroups: (this.data != null) ? this.data : []
            };
        },
        methods: {

            addGroup() {

                this.discountGroups.push({
                    discount_type: 'percent',
                    discount_amount: '',
                    products: []
                });

            },

            save() {
                let data = this.$refs.groups.map((group) => {
                    return group.getDiscountSpecification();
                });

                this.$emit('save', data);
            }

        }
    }
</script>