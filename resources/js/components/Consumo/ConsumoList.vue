<template>
    <div>
        <div class="col-12">
            <h5>Consumos de la reserva</h5>
            <div class="card-body table-responsive p-0 text-black-50">
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
                                {{ consumo.created_at | formatDateTime }}
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
        </div>
    </div>
</template>
<script>
export default {
    props: ["consumos"],
    methods: {
        deleteConsumo(consumo) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar este consumo?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios.delete("/consumo/" + consumo.id).then(() => {
                        this.$store.dispatch(
                            "fetchReserva",
                            consumo.reservas_id
                        );
                        this.$store.dispatch("fetchReservas");
                        Swal.fire(
                            "Eliminado!",
                            "El consumo se elimino correctamente.",
                            "success"
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
