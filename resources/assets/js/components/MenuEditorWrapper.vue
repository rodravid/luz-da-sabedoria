<template>
    <menu-editor @save="save" :data="data" :limit="9"></menu-editor>
</template>
<script type="text/javascript">

    import MenuEditor from './menu-editor/MenuEditor.vue'

    export default {
        components: {
            MenuEditor
        },

        props: ['data'],

        methods: {

            save(data) {

                this.$http.post('/cms/site-menu', {data}).then(() => {
                    swal('Pronto!', 'Alterações salvas com sucesso!', 'success');
                });

            }

        }
    }
</script>
