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
        </div>
    </li>
</template>
<script type="text/javascript">

    import { isArray } from 'lodash';

    export default {

        props: {
            index: {
                type: Number
            },
            data: {
                default: function() {
                    return {
                        title: '',
                        url: '',
                        target: '_self',
                    }
                }
            }
        },

        created() {
          if (isArray(this.data)) {
              this.item = {
                  title: '',
                  url: '',
                  target: '_self',
              };
          }
        },

        data() {
            return {
                item: this.data
            }
        },

        methods: {
            getData() {
                return {
                    type: 'unique-link',
                    data: {...this.item}
                };
            }
        }
    }
</script>
