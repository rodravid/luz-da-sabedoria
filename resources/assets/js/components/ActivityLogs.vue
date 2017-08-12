<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Log de ações</h3>
                </div>

                <div class="box-body">
                    <table v-if="hasLogs()" class="table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#ID</th>
                                <th style="width: 8%;"><i class="fa fa-user"></i> Usuário</th>
                                <th><i class="fa fa-edit"></i> Ação</th>
                                <th style="width: 15%;"><i class="fa fa-calendar-o"></i> Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="log in logs">
                                <td>{{ log.id }}</td>
                                <td>{{ log.user }}</td>
                                <td>{{ log.message }}</td>
                                <td>{{ log.date }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h4 v-if="! hasLogs()" class="text-center">Nenhum log encontrado.</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        mounted() {
            this.logs = JSON.parse(this.activityLogs);
        },
        data() {
            return {
                logs: []
            }
        },
        methods: {
            hasLogs() {
                return this.logs.length != 0;
            }
        },
        props: {
            activityLogs: {
                type: String,
                required: true
            }
        }
    }
</script>
