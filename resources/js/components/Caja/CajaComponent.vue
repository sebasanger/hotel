<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div
                            class="input-group input-group-sm float-right"
                            style="width: 250px;"
                        >
                            <select
                                v-model="search"
                                name="categorias_id"
                                @change="buscar()"
                                class="form-control"
                            >
                                <option value>Filtrar por usuario</option>
                                <option
                                    v-for="u in users"
                                    :key="u.id"
                                    :value="u.id"
                                    >{{ u.name }}</option
                                >
                            </select>
                        </div>
                        <h5>Cajas</h5>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table
                            class="table table-bordered table-hover dataTable table-fixed"
                        >
                            <thead>
                                <tr>
                                    <th>Encargado</th>
                                    <th>Monto de apertura</th>
                                    <th>Fecha de apertura</th>
                                    <th>Monto de cierre</th>
                                    <th>Fecha de cierre</th>
                                    <th>Saldo</th>
                                    <th>Ganancia</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <transition-group tag="tbody" name="fade-list">
                                <tr
                                    v-for="item in cajas.data"
                                    :key="item.id"
                                    class="list-complete-item"
                                >
                                    <td>{{ item.name | capitalize }}</td>
                                    <td class="text-center">
                                        {{ item.montoApertura }}
                                    </td>
                                    <td class="text-center">
                                        {{
                                            item.created_at
                                                | formatDateTimeComplete
                                        }}
                                    </td>
                                    <td
                                        class="text-center"
                                        :class="[
                                            item.montoCierre >=
                                            item.montoApertura
                                                ? 'text-success'
                                                : 'text-danger'
                                        ]"
                                    >
                                        {{ item.montoCierre }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.horaCierre }}
                                    </td>
                                    <td
                                        class="text-center "
                                        :class="[
                                            item.montoCierre == item.saldo
                                                ? 'text-success'
                                                : 'text-danger'
                                        ]"
                                    >
                                        {{ item.saldo }}
                                    </td>
                                    <td
                                        class="text-center "
                                        :class="[
                                            item.saldo - item.montoApertura >= 0
                                                ? 'text-success'
                                                : 'text-danger'
                                        ]"
                                    >
                                        {{ item.saldo - item.montoApertura }}
                                    </td>
                                    <td class="text-center">
                                        <button
                                            v-show="item.cajaActiva != 1"
                                            class="btn"
                                            @click="cajaShow(item.id)"
                                        >
                                            <i class="fa fa-eye green"></i>
                                        </button>
                                    </td>
                                </tr>
                            </transition-group>
                        </table>
                    </div>

                    <div class="card-footer">
                        <pagination
                            :data="cajas"
                            :limit="3"
                            @pagination-change-page="getResults"
                        ></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    data() {
        return {
            paginaActual: 1,
            search: "",
            users: {}
        };
    },
    created() {
        this.loadUsers();
        this.getResults(this.paginaActual);
    },
    computed: {
        ...mapState("caja", ["cajas"])
    },
    mounted() {
        this.$Progress.finish();
    },

    methods: {
        cajaShow(cajaId) {
            this.$router.push({
                name: "cajaShow",
                params: { id: cajaId }
            });
        },
        getResults(page) {
            let query = this.search;
            this.paginaActual = page;
            let payload = { query: query, pagina: this.paginaActual };
            this.$store.dispatch("caja/fetchCajas", payload);
        },
        loadUsers() {
            axios.get("getAllUsers").then(res => (this.users = res.data));
        },
        buscar: _.debounce(function() {
            this.getResults();
        }, 50)
    }
};
</script>
