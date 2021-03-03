<template>
    <div>
        <h3 class="text-center">Editar Tarefa</h3>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form @submit.prevent="updateCategoria">
                        <div class="form-group">
                            <label>Nome do Tipo de Tarefa</label>
                            <input type="text" required class="form-control" v-model="categoria.nome">     
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
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
        created() {
            this.axios
                .get(`http://localhost:8000/api/tarefas/editCategoria/${this.$route.params.id}`)
                .then((response) => {
                    this.categoria = response.data;
                })
                .catch(error => { console.log(error)})
                .finally(() => this.loading = false);
        },
        methods: {
            updateCategoria() {
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
                            .post(`http://localhost:8000/api/tarefas/updateCategoria/${this.$route.params.id}`, this.categoria)
                            .then((response) => {
                                this.$router.push({name: 'list'});
                            })
                            .catch(error =>  console.log(error))
                            .finally(() => this.loading = false);
                }})
            }
        }
    }
</script>