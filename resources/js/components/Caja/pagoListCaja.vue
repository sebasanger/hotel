<template>
    <div>
        <div class="col-12">
            <h5>Pagos de la reserva</h5>

            <div class="card-body table-responsive p-0 text-black-50">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Monto</th>
                            <th>Modo de pago</th>
                            <th>Encargado de la transaccion</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Habitacion</th>
                            <th>Estado de la reserva</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tr
                        v-for="pago in pagos"
                        :key="pago.id"
                        class="list-complete-item"
                    >
                        <td>{{ pago.monto }}</td>
                        <td>
                            {{ pago.modoPago }}
                        </td>
                        <td>
                            {{ pago.name | capitalize }}
                        </td>
                        <td>
                            {{ pago.created_at | formatDateTime }}
                        </td>
                        <td>
                            {{ pago.nombre + " " + pago.apellido }}
                        </td>
                        <td>
                            {{ pago.numeroHabitacion }}
                        </td>
                        <td>
                            {{ pago.estado | estadoReserva }}
                        </td>
                        <td class="text-center">
                            <button
                                :disabled="pago.estado == 0"
                                class="btn ml-2"
                                @click="deletePago(pago)"
                            >
                                <i class="fa fa-trash red"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["pagos"],
    methods: {
        deletePago(pago) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar este pago?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/pago/" + pago.id)
                        .then(() => {
                            this.$store.dispatch("caja/fetchCajaActiva");
                            this.$store.dispatch("fetchReservas");
                            Swal.fire(
                                "Eliminado!",
                                "El pago se elimino correctamente.",
                                "success"
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error!",
                                "No se pudo eliminar el pago.",
                                "error"
                            );
                        });
                }
            });
        }
    }
};
</script>
<style scoped>
.table tr th {
    font-size: 15px;
}
</style>
