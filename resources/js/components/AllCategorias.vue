<template>
    <div>
        <h3 class="text-center">Tipos de Tarefas</h3><br/>
        
        <div class="pb-2"> 
            <router-link :to="{name: 'addCategoria'}" class="btn btn-success mr-1">Criar Tipo <i class="fas fa-plus"></i>
            </router-link>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="categoria in categorias" :key="categoria.id">
                <td class="col-md-3">{{ categoria.nome }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editCategoria', params: { id: categoria.id }}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i>
                        </router-link>
                        <button class="btn btn-danger" @click="deleteCategoria(categoria.id)"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {                
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
                
        },
        methods: {
            deleteCategoria(id) {
               this.$swal.fire({
                title: 'Tem certeza que deseja excluir o tipo de Tarefa?',
                text: "Essa ação não pode ser revertida!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios
                            .delete(`http://localhost:8000/api/tarefas/deleteCategoria/${id}`)
                            .then(response => {
                                let i = this.categorias.map(item => item.id).indexOf(id); // find index of your object
                                this.categorias.splice(i, 1)
                            });
                    }
                })
                    
            }
        },
    }
</script>