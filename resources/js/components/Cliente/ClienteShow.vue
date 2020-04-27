<template>
    <div>
        <p>DNI: {{ cliente.dni }}</p>
        <p>
            Nombre completo:
            {{ (cliente.nombre + " " + cliente.apellido) | toUpperCase }}
        </p>
        <p>Profesion: {{ cliente.profecion }}</p>
        <p>Procedencia: {{ cliente.procedencia | toUpperCase }}</p>
        <p>Destino: {{ cliente.destino | toUpperCase }}</p>
        <p>Domicilio: {{ cliente.domicilio | toUpperCase }}</p>
        <p>Tipo de factura: {{ cliente.tipoFactura }}</p>
        <p>Fecha de nacimiento: {{ cliente.fechaNacimiento | formatDate }}</p>

        <router-link :to="{ name: 'cliente' }">atras</router-link>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    props: ["id"],
    created() {
        this.$store
            .dispatch("cliente/fetchCliente", this.id)
            .then(() => {
                this.$Progress.finish();
            })
            .catch(() => {
                this.$Progress.fail();
            });
    },
    computed: {
        ...mapState("cliente", ["cliente"])
    }
};
</script>
