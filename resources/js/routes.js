import AllTarefas from './components/AllTarefas.vue';
import AllCategorias from './components/AllCategorias.vue';
import AddTarefa from './components/AddTarefa.vue';
import AddCategoria from './components/AddCategoria.vue';
import EditTarefa from './components/EditTarefa.vue';
import EditCategoria from './components/EditCategoria.vue';

 
export const routes = [
    {
        name: 'home',
        path: '/home',
        component: AllTarefas,
    },
    {
        name: 'add',
        path: '/add',
        component: AddTarefa,
    },
    {
        name: 'list',
        path: '/list',
        component: AllCategorias,
    },
    {
        name: 'addCategoria',
        path: '/addCategoria',
        component: AddCategoria,
    },
    {
        name: 'editCategoria',
        path: '/editCategoria',
        component: EditCategoria,
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditTarefa,
    },
];