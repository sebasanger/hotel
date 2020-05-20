<template>
    <div>
        <div class="col-12">
            <h5>Reservas realizadas por el cliente</h5>

            <div class="card-body table-responsive p-0 text-black-50">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha de ingreso</th>
                            <th>Fecha de egreso</th>
                            <th>Numero de habitacion</th>
                            <th>Cantidad de huespedes</th>
                            <th>Precio por dia</th>
                            <th>Total a pagar</th>
                            <th>Total pagado</th>
                            <th>encargado</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="reserva in reservas"
                            :key="reserva.id"
                            class="list-complete-item"
                        >
                            <td>
                                {{ reserva.ingreso | formatDateComplete }}
                            </td>
                            <td>
                                {{ reserva.egreso | formatDateComplete }}
                            </td>
                            <td>
                                {{ reserva.numeroHabitacion }}
                            </td>
                            <td>
                                {{ reserva.huespedes }}
                            </td>
                            <td>
                                {{ reserva.precio }}
                            </td>
                            <td>
                                {{ reserva.totalPagar }}
                            </td>
                            <td
                                :class="[
                                    reserva.pagado >= reserva.totalPagar
                                        ? 'bg-success'
                                        : 'bg-danger'
                                ]"
                            >
                                {{ reserva.pagado }}
                            </td>
                            <td>
                                {{ reserva.name }}
                            </td>
                            <td>
                                {{ reserva.estado | estadoReserva }}
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
    props: ["reservas"]
};
</script>
<style scoped>
.table tr th {
    font-size: 15px;
}
</style>
