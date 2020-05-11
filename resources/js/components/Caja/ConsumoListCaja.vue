<template>
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Consumos de la reserva</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Modo de pago</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Encargado de la transaccion</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Habitacion</th>
                                <th>Estado de la reserva</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="consumo in consumos"
                                :key="consumo.id"
                                class="list-complete-item"
                            >
                                <td>{{ consumo.producto }}</td>
                                <td>
                                    {{ consumo.modoPago }}
                                </td>
                                <td>
                                    {{ consumo.precio }}
                                </td>
                                <td>
                                    {{ consumo.cantidad }}
                                </td>
                                <td>
                                    {{ consumo.precio * consumo.cantidad }}
                                </td>
                                <td>
                                    {{ consumo.name | capitalize }}
                                </td>
                                <td>
                                    {{ consumo.created_at }}
                                </td>
                                <td>
                                    {{
                                        consumo.nombre + " " + consumo.apellido
                                    }}
                                </td>
                                <td>
                                    {{ consumo.numeroHabitacion }}
                                </td>
                                <td>
                                    {{ consumo.estado | estadoReserva }}
                                </td>
                                <td class="text-center">
                                    <button
                                        class="btn ml-2"
                                        @click="deleteConsumo(consumo)"
                                    >
                                        <i class="fa fa-trash red"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>
<script>
export default {
    props: ["consumos"],
    methods: {
        deleteConsumo(pago) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar este consumo?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/consumo/" + pago.id)
                        .then(() => {
                            this.$store.dispatch("caja/fetchCajaActiva");
                            this.$store.dispatch("fetchReservas");
                            Swal.fire(
                                "Eliminado!",
                                "El consumo se elimino correctamente.",
                                "success"
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error!",
                                "No se pudo eliminar el consumo.",
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
table {
    text-align: center;
}
</style>
