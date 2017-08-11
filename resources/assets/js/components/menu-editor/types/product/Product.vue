<template>
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Título do box" v-model="product.title">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Código do produto" v-model="product.id">
                </div>
            </div>
        </div>
    </li>
</template>
<script type="text/javascript">

    export default {

        props: {
            index: {
                type: Number
            },
            data: {
                default: function() {
                    return {
                        id: '',
                        title: ''
                    }
                }
            }
        },

        data() {
            return {
                product: this.data
            }
        },

        methods: {
            getData() {
                return {
                    type: 'product',
                    data: {...this.product}
                };
            }
        }
    }
</script>
