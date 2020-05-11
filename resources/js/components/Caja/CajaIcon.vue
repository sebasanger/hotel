<template>
    <div>
        <li class="nav-item dropdown" v-if="caja.cajaActiva">
            <router-link
                class="nav-link"
                data-toggle="dropdown"
                :to="{ name: 'cajaActiva' }"
                aria-expanded="false"
            >
                <i class="fas fa-cash-register fa-lg white mr-2"></i>
                <span class="badge badge-info navbar-badge">$</span>
            </router-link>
        </li>
        <li class="nav-item dropdown" v-else>
            <a
                class="nav-link"
                data-toggle="dropdown"
                aria-expanded="false"
                @click="abrirCaja()"
            >
                <i class="fas fa-cash-register fa-lg white mr-2"></i>
                <span class="badge badge-danger navbar-badge">#</span>
            </a>
        </li>
        <modal-abrir-caja :formCaja="formCaja" />
    </div>
</template>
<script>
import { mapState } from "vuex";
import ModalAbrirCaja from "./AbrirCajaModal.vue";
export default {
    components: {
        ModalAbrirCaja
    },
    computed: {
        ...mapState("caja", ["caja"])
    },
    data() {
        return {
            formCaja: new Form({
                montoApertura: 0
            })
        };
    },

    methods: {
        abrirCaja() {
            this.formCaja.reset();
            $("#abrirCaja")
                .appendTo("body")
                .modal("show");
        }
    }
};
</script>
