<template>
    <div>
        

        <h3 class="mt-2">Cajas</h3>
        <ul class="list-group mt-2">
            <li
                class="list-group-item"
                v-for="(caja, index) in cajas"
                :key="index"
            >
                <span class="badge badge-primary float-right"
                    >Hora de apertura: {{ caja.created_at }}</span
                >
                <p>Monto de apertura: {{ caja.montoApertura }}</p>
                <p>Hora de Cierre: {{ caja.horaCierre }}</p>
                <p>Monto de cierre: {{ caja.montoCierre }}</p>
                <p>Encargado: {{ caja.users_id }}</p>
            </li>
        </ul>
        <hr>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cajas: []
        };
    },
    mounted() {
        axios.get("/cajas").then(res => {
            this.cajas = res.data;
        });
    }
};
</script>
