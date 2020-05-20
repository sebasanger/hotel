<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <!-- data de la caja -->
                        <div class="col-md-5">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <cliente-data
                                        :cliente="cliente"
                                        :cantidadReservas="
                                            reservasByCliente.length
                                        "
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- cierre data de la reserva -->

                        <!-- data multiple -->
                        <div
                            class="col-md-12"
                            v-if="reservasByCliente.length >= 1"
                        >
                            <div class="card card-dark">
                                <!--  para cambiar de tablas -->
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a
                                                class="nav-link active text-white"
                                                href="#reservas"
                                                data-toggle="tab"
                                                >Reservas</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div
                                            class="tab-pane active"
                                            id="reservas"
                                            v-if="reservasByCliente.length >= 1"
                                        >
                                            <reservas-list
                                                :reservas="reservasByCliente"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import clienteData from "./ClienteData.vue";
import reservasList from "./ReservasList.vue";

export default {
    components: {
        clienteData,
        reservasList
    },

    computed: {
        ...mapState("cliente", ["cliente"]),
        ...mapState(["reservasByCliente"])
    },
    created() {
        this.cargar();
    },
    methods: {
        async cargar() {
            try {
                this.$store
                    .dispatch("cliente/fetchCliente", this.$route.params.id)
                    .then(res => {
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            } catch (e) {
                console.error(e);
            }
        }
    }
};
</script>
<style scoped>
.card {
    color: white;
}
</style>
