<template>
    <div>
        <h3 class="text-center">Tarefas</h3><br/>
        <div class="pb-2"> 
            <select required class="form-control col-4" v-model="filtro">
                <option value="" disabled selected>Filtar por Tipo</option>
                <option value="All">Todas</option>
                <option v-for="categoria in categorias" :key="categoria.id" v-bind:value="categoria.nome">{{ categoria.nome }}</option>
            </select>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Status</th>
                <th>Data Limite</th>
                <th>Tipo de Tarefa</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="tarefa in searchTask" :key="tarefa.id">
                <td>
                    <input type="radio" class="form-control" v-model="tarefa.status">
                </td>
                <td>{{ tarefa.data_limite }}</td>
                <td>
                    <ul v-for="categoria in tarefa.categorias" :key="tarefa.categorias.id" class="list-group">
                       <li class="list-group-item"> {{ categoria.nome }} </li>
                    </ul>
                </td>
                <td>{{ tarefa.descricao }}</td>
                <td>
                    <div class="btn-group d-flex" role="group">
                        <router-link :to="{name: 'edit', params: { id: tarefa.id }}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i>
                        </router-link>
                        <button class="btn btn-danger" @click="deleteTarefa(tarefa.id)"><i class="fas fa-trash"></i></button>
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
                tarefas: [],
                categorias: [],
                filtro: ''
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
                .get('http://localhost:8000/api/tarefas/home')
                .then(response => {
                    this.tarefas = response.data;
                })
                .catch(error =>  console.log(error))
                .finally(() => this.loading = false)      
                
        },
        methods: {
            deleteTarefa(id) {
               this.$swal.fire({
                title: 'Tem certeza que deseja excluir a Tarefa?',
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
                            .delete(`http://localhost:8000/api/tarefas/delete/${id}`)
                            .then(response => {
                                let i = this.tarefas.map(item => item.id).indexOf(id); // find index of your object
                                this.tarefas.splice(i, 1)
                            });
                    }
                })
                    
            }
        },
        computed: {
            searchTask(){
                if(this.filtro){
                    if(this.filtro=="All"){
                        return this.tarefas;
                    }else{
                        return this.tarefas.filter((item)=>{
                            return item.categorias.find(categoria => categoria.nome === this.filtro);
                        })
                    }
                }else{
                    return this.tarefas;
                }
            }
        }
    }
</script>