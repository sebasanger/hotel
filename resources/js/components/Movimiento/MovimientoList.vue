<template>
    <div>
        <div class="col-12">
            <h5>Movimientos de la caja</h5>
            <div class="card-body table-responsive p-0 text-black-50">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Monto</th>
                            <th>Descripcion</th>
                            <th>Modo de pago</th>
                            <th>Fecha</th>
                            <th>Encargado</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="movimiento in movimientos"
                            :key="movimiento.id"
                            class="list-complete-item"
                        >
                            <td>
                                {{ movimiento.monto }}
                            </td>
                            <td>
                                {{ movimiento.descripcion }}
                            </td>
                            <td>
                                {{ movimiento.modoPago }}
                            </td>
                            <td>
                                {{ movimiento.created_at | formatDateTime }}
                            </td>
                            <td>
                                {{ movimiento.name }}
                            </td>

                            <td class="text-center">
                                <button
                                    class="btn ml-2"
                                    @click="deleteMovimiento(movimiento)"
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
    props: ["movimientos"],
    methods: {
        deleteMovimiento(movimiento) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar este movimiento?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/movimiento/" + movimiento.id)
                        .then(() => {
                            this.$store.dispatch("caja/fetchCajaActiva");
                            Swal.fire(
                                "Eliminado!",
                                "El movimiento se elimino correctamente.",
                                "success"
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error!",
                                "No se pudo eliminar el movimiento.",
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
