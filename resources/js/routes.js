import AllCliente from './components/AllCliente.vue';
import CreateCliente from './components/CreateCliente.vue';
import EditCliente from './components/EditCliente.vue';
// AQUI CONSTRUIMOS AS NOSSAS ROTAS QUE VAMOS USAR NO SISTEMA. http://127.0.0.1:8000/edit/40 POR EXEMPLO.
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllCliente
    },
    {
        name: 'create',
        path: '/create',
        component: CreateCliente
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditCliente
    }
];
