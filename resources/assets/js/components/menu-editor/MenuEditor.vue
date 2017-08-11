<template>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-group" id="menuGroupList">
                        <li class="list-group-item" v-if="items.length <= 0">Nenhum menu adicionado.</li>
                        <li class="list-group-item" v-for="(item, index) in items" style="padding: 20px 10px;" :data-index="index" :key="item">
                            <menu-group :data="item" v-on:remove="items.splice(index, 1)" :is-collapsed="item.collapsed" ref="group"></menu-group>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <button type="button" class="btn btn-success" @click="save"><i class="fa fa-plus-circle"></i> Salvar e publicar</button>
                    <button type="button" class="btn btn-default" @click="addMenu" v-show="items.length < limit"><i class="fa fa-plus-circle text-success"></i> Adicionar menu ({{ remaining }})</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">

    import MenuGroup from './MenuGroup.vue'

    export default {
        components: {
            MenuGroup
        },
        props: {
            data: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            limit: {
                type: Number,
                default: 10,
            }
        },
        data() {
            return {
                items: this.data
            };
        },

        computed: {
            remaining: function() {
                let count = this.limit - this.items.length;
                return `${count} ${count === 1 ? 'restante' : 'restantes'}`;
            }
        },

        mounted() {

            let self = this;
            let $sortable = $(self.$el).find('#menuGroupList');

            $sortable.sortable({
                handle: '.btn-sort',
                cancel: '',
                axis: 'y',
                stop: function() {

                    let oldArray = self.items;
                    let newArray = [];
                    let oldRefs = self.$refs.group;
                    let newRefs = [];

                    $sortable.children().each(function() {
                        let index = parseInt($(this).attr('data-index'));
                        newArray.push(oldArray[index]);
                        newRefs.push(oldRefs[index]);
                    });

                    self.items = newArray;
                    self.$refs.group = newRefs;
                }
            });

        },

        methods: {

            addMenu() {

                if (this.items.length + 1 > this.limit) {
                    return false;
                }

                this.items.push({
                    title: '',
                    url: '',
                    collapsed: false,
                    template: 'template1',
                    columns: [
                        {
                            type: 'list',
                            data: []
                        },
                        {
                            type: 'list',
                            data: []
                        },
                        {
                            type: 'list',
                            data: []
                        }
                    ]
                });

            },

            save() {
                let data = this.$refs.group.map((group) => {
                    return group.getData();
                });

                this.$emit('save', data);
            }

        }
    }
</script>
