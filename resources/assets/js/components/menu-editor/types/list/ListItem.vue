<template>
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Título do link" v-model="item.title">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="URL" v-model="item.url">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <select name="" class="form-control" style="-webkit-appearance: none;" v-model="item.target">
                        <option value="_self">Abre na mesma janela</option>
                        <option value="_blank">Abre em uma nova janela</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" v-model="item.highlighted"> Destacado?</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="btn-group pull-right">
                    <button class="btn btn-default btn-sort" title="Clique e arraste para ordenar"><i class="fa fa-arrows"></i></button>
                    <button class="btn btn-default" @click="$emit('remove')" title="Remover"><i class="fa fa-remove text-danger"></i></button>
                </div>
            </div>
        </div>
    </li>
</template>
<script type="text/javascript">

    export default {

        props: {
            data: {
                default: function() {
                    return {
                        title: '',
                        url: '',
                        target: '_self',
                        highlighted: false
                    }
                }
            }
        },

        data() {
            return {
                item: this.data
            }
        }
    }
</script>
