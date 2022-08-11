    <template>
    <div class="row">
        <h3 class="text-center">Novo Cliente</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCliente">
                <!-- DENTRO DE CADA INPUT FOI DEFINIDO O TIPO DE CAMPO. PELA VIEW FOI DEFINIDO QUE TODOS OS CAMPOS DEVEM SER PREENCHIDOS.-->
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="cliente.nome" required>
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>
                        <input type="date" class="form-control" v-model="cliente.dataNascimento" required>
                    </div>
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" class="form-control" v-model="cliente.cpf" v-mask="'###.###.###-##'"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" class="form-control" v-model="cliente.telefone"
                            v-mask="['(##) ####-####', '(##) #####-####']" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="cliente.email" required>
                    </div>
                    <div class="form-group">
                        <label>Data Alt</label>
                        <input type="date" class="form-control" v-model="cliente.data_alt" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Criar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cliente: {}
        }
    },
    methods: {
        addCliente() {
            this.axios
                .post('http://localhost:8000/api/clientes', this.cliente)
                .then(response => (
                    this.$router.push({ name: 'home' })
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>
