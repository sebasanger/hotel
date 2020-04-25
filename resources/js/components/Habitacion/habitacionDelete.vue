<template>
    <button class="btn  ml-2" @click="deleteHabitacion(id)">
        <i class="fa fa-trash red"></i>
    </button>
</template>

<script>
export default {
    props: ["id"],
    methods: {
        deleteHabitacion(id) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar esta habitacion?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("habitacion/" + id)
                        .then(() => {
                            this.loadHabitaciones();
                            Swal.fire(
                                "Eliminado!",
                                "La habitacion se elimino correctamente.",
                                "success"
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error!",
                                "No se pudo eliminar la habitacion",
                                "error"
                            );
                        });
                }
            });
        },
        getResults(page = 1) {
            axios.get("habitacion?page=" + page).then(res => {
                this.habitaciones = res.data;
            });
        }
    }
};
</script>
