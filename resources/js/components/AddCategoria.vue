<template>
    <div>
        <h3 class="text-center">Criar Tipo de Tarefa</h3>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form @submit.prevent="addTipoTarefa">
                        <div class="form-group">
                            <label>Nome do Tipo de Tarefa</label>
                            <input type="text" required class="form-control" v-model="categoria.nome">
                        </div>
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <router-link :to="{name: 'list'}" class="btn btn-secondary mr-1">Cancelar
                        </router-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categoria: {},
            }
        },
        methods: {
            addTipoTarefa() {
                this.axios
                    .post('http://localhost:8000/api/tarefas/createCategoria', this.categoria)
                    .then(response => (
                        this.$router.push({name: 'list'})
                    ))
                    .catch(error =>  console.log(error))
                    .finally(() => this.loading = false)    
                    }
        }
    }
</script>