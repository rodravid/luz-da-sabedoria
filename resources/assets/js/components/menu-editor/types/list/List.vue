<template>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-group list-item-sortable">
                <li class="list-group-item" v-if="items.length <= 0">Nenhum item adicionado.</li>
                <list-item :data="item" v-for="(item, index) in items" v-on:remove="items.splice(index, 1)" :data-index="index" :key="item"></list-item>
            </ul>
            <button class="btn btn-default" @click="addItem" v-show="items.length < limit"><i class="fa fa-plus-circle text-success"></i> Adicionar item ({{ remaining }})</button>
        </div>
    </div>
</template>
<script type="text/javascript">

    import ListItem from './ListItem.vue'

    export default{
        components: {
            ListItem
        },
        props: {
            index: {
              type: Number
            },
            title: {
                type: String,
            },
            limit: {
                type: Number,
                required: false,
                default: 6
            },
            data: {
                default: function() {
                    return [];
                }
            }
        },
        created() {
            if (typeof this.data.length !== 'undefined') {
                this.items = this.data;
            } else {
                this.items = [];
            }
        },

        mounted() {

            let self = this;
            let $sortable = $(self.$el).find('.list-item-sortable');

            $sortable.sortable({
                handle: '.btn-sort',
                cancel: '',
                axis: 'y',
                stop: function() {

                    let oldArray = self.items;
                    let newArray = [];

                    $sortable.children().each(function() {
                        let index = parseInt($(this).attr('data-index'));
                        newArray.push(oldArray[index]);

                    });

                    self.items = newArray;
                }
            });

        },

        data() {
            return {
                items: []
            }
        },

        computed: {
            remaining: function() {
                let count = this.limit - this.items.length;
                return `${count} ${count === 1 ? 'restante' : 'restantes'}`;
            }
        },

        methods: {

            addItem() {

                if (this.items.length + 1 > this.limit) {
                    return false;
                }

                this.items.push({
                    title: '',
                    url: '',
                    target: '_self',
                    highlighted: false,
                });
            },

            getData() {

                let items = [];

                this.items.map((item) => {
                    items.push({...item});
                });

                return {
                    type: 'list',
                    data: items
                };
            }
        }
    }
</script>
