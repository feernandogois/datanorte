<template>
    <div class="row">
        <div class="col-lg-12" style="text-align: center">
            <h2 class="text-center">Lista de Clientes</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Data Alt</th>
                        <!-- VERIFICAR O PORQUE DESSA DATA ALT... SERÁ QUE NÃO SERIA O UPDATED_AT DO TIMESTAMPS?-->
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="cliente in clientesDelimitado" :key="cliente.id">
                        <td>{{ cliente.id }}</td>
                        <td>{{ cliente.nome }}</td>
                        <!-- VERIFICAR COMO EXIBIR A DATA NO PADRÃO d-m-Y -->
                        <td>{{ cliente.dataNascimento }}</td>
                        <td>{{ cliente.cpf }}</td>
                        <td>{{ cliente.telefone }}</td>
                        <td>{{ cliente.email }}</td>
                        <td>{{ cliente.data_alt }}</td>
                        <td style="width: 25%;">

                            <router-link :to="{ name: 'edit', params: { id: cliente.id } }" class="btn btn-success">
                                Editar
                            </router-link>
                            <button type="button" class="btn btn-danger"
                                @click="deleteCliente(cliente.id)">Deletar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <jw-pagination :pageSize=5 :items="clientes" @changePage="onChangePage"></jw-pagination>
            </div>
        </div>
    </div>

</template>
<script>
// an example array of items to be paged
// npm i jw-vue-pagination
const exampleItems = [...Array(150).keys()].map(i => ({ id: (i + 1), name: 'Item ' + (i + 1) }));
export default {
    data() {
        return {
            clientes: [],
            exampleItems,
            clientesDelimitado: [],
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/clientes')
            .then(response => {
                this.clientes = response.data;
            });
    },
    methods: {
        deleteCliente(id) {
            this.axios
                .delete(`http://localhost:8000/api/clientes/${id}`)
                .then(response => {
                    let i = this.clientes.map(data => data.id).indexOf(id);
                    this.clientes.splice(i, 1)
                });
        },
        onChangePage(pageOfItems) {
            //console.log(pageOfItems)
            // update page of items
            this.clientesDelimitado = pageOfItems;
        }
    },

}
</script>
