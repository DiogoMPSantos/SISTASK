<template>
    <div>
        <h3 class="text-center">Editar Tarefa</h3>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form @submit.prevent="updateTarefa">
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" required class="form-control" v-model="tarefa.descricao">     
                        </div>
                        <div class="form-group">
                            <label>Tipo de Tarefa</label>
                            <select required class="form-control" v-model="tarefa.tipo_tarefa">
                                <option v-for="categoria in categorias" :key="categoria.id" v-bind:value="categoria.id">{{ categoria.nome }}</option>
                            </select>
                        </div>
                                <div class="form-group">
                                <label>Data Limite</label>
                                <input type="date" class="form-control" required v-model="tarefa.data_limite">
                            </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <router-link :to="{name: 'home'}" class="btn btn-secondary mr-1">Cancelar
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
                tarefa: {},
                categorias: [],
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/tarefas/categorias')
                .then(response => {
                    this.categorias = response.data;
                })
                .catch(error =>  console.log(error))
                .finally(() => this.loading = false)  

            this.axios
                .get(`http://localhost:8000/api/tarefas/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.tarefa = response.data;
                })
                .catch(error => { console.log(error)})
                .finally(() => this.loading = false);
        },
        methods: {
            updateTarefa() {
                this.$swal.fire({
                title: 'Tem certeza que deseja atualizar a Tarefa?',
                text: "Atualizar Tarefa",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, atualizar',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios
                            .post(`http://localhost:8000/api/tarefas/update/${this.$route.params.id}`, this.tarefa)
                            .then((response) => {
                                this.$router.push({name: 'home'});
                            })
                            .catch(error =>  console.log(error))
                            .finally(() => this.loading = false);
                }})
            }
        }
    }
</script>