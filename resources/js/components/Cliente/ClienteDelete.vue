<template>
    <button class="btn ml-2" @click="deleteCliente(id, index)">
        <i class="fa fa-trash red"></i>
    </button>
</template>
<script>
export default {
    props: ["index", "id", "search", "paginaActual"],
    methods: {
        deleteCliente(id) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar este cliente?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios.delete("cliente/" + id).then(() => {
                        //se elimina el usuario y se cargan los datos nuevmanete manteniendo el filtro y la pagina
                        this.getResults();
                        Swal.fire(
                            "Eliminado!",
                            "El cliente se elimino correctamente.",
                            "success"
                        );
                    });
                }
            });
        },
        getResults(page) {
            let payload = { query: this.search, pagina: this.paginaActual };
            this.$store.dispatch("cliente/fetchClientes", payload);
        }
    }
};
</script>
