<template>
    <div>
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title text-center">
                    Datos del cliente
                </h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="fas fa-user mr-1"></i> Nombre</strong>
                <p>
                    {{ (cliente.nombre + " " + cliente.apellido) | capitalize }}
                </p>

                <div v-if="cliente.dni">
                    <hr />
                    <strong><i class="fas fa-passport mr-1"></i> DNI</strong>

                    <p>
                        {{ cliente.dni }}
                    </p>
                </div>

                <div v-if="cliente.tipoFactura">
                    <hr />
                    <strong
                        ><i class="fas fa-sticky-note mr-1"></i> Tipo de
                        factura</strong
                    >

                    <p>
                        {{ cliente.tipoFactura }}
                    </p>
                </div>

                <div v-if="cliente.celular">
                    <hr />
                    <strong><i class="fas fa-phone mr-1"></i> Celular</strong>

                    <p>
                        {{ cliente.celular }}
                    </p>
                </div>

                <div v-if="cliente.domicilio">
                    <hr />
                    <strong
                        ><i class="fas fa-home mr-1"></i> Domicilio del
                        cliente</strong
                    >
                    <p>
                        {{ cliente.domicilio }}
                    </p>
                </div>

                <div v-if="cliente.profecion">
                    <hr />
                    <strong
                        ><i class="fas fa-briefcase mr-1"></i> Profecion del
                        cliente</strong
                    >
                    <p>
                        {{ cliente.profecion }}
                    </p>
                </div>

                <a
                    @click="editCliente(cliente)"
                    class="btn btn-primary btn-block btn-info text-white"
                    >Editar cliente</a
                >
                <button
                    class="btn btn-primary btn-block btn-info text-white"
                    @click="clienteShow(cliente.id)"
                >
                    Ver detalles
                </button>
            </div>

            <modal-cliente
                :form="formCliente"
                :facturas="facturas"
                :reserva="reserva"
                :editMode="true"
            />
        </div>
    </div>
</template>

<script>
import ModalCliente from "../Cliente/clienteModal.vue";

export default {
    components: {
        ModalCliente
    },
    props: ["reserva", "facturas", "cliente"],
    data() {
        return {
            formCliente: new Form({
                id: "",
                nombre: "",
                apellido: "",
                dni: "",
                facturas_id: "",
                celular: "",
                domicilio: "",
                profecion: ""
            })
        };
    },

    methods: {
        clienteShow(clienteId) {
            this.$router.push({
                name: "clienteShow",
                params: { id: clienteId }
            });
        },
        editCliente(cliente) {
            this.editMode = true;
            this.formCliente.reset();
            this.$store.dispatch("carga/fetchAllFacturas");
            $("#addEditCliente").modal("show");
            this.formCliente.fill(cliente);
        }
    }
};
</script>
<style scoped>
p {
    font-size: medium;
}
table {
    text-align: center;
}
.card {
    color: white;
}

.card p {
    text-align: center;
}
</style>
