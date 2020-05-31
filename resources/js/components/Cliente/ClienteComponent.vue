<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div
                            class="input-group input-group-sm float-left pt-2"
                            style="width: 200px;"
                        >
                            <input
                                autocomplete="off"
                                type="text"
                                name="table_search"
                                class="form-control "
                                placeholder="Nombre, apellido, email..."
                                v-model="search"
                                @keydown="buscar()"
                            />
                        </div>
                        <button
                            class="btn-info float-right text-white"
                            @click="newModal"
                        >
                            Agregar cliente
                        </button>
                        <h5>Clientes</h5>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table
                            class="table table-bordered table-hover dataTable table-fixed"
                        >
                            <thead>
                                <tr>
                                    <th>DNI</th>
                                    <th>Nombre y apellido</th>
                                    <th>Celular</th>
                                    <th>Domicio</th>
                                    <th>Profecion</th>
                                    <th>Factura</th>
                                    <th>Detalles</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <transition-group tag="tbody" name="fade-list">
                                <tr
                                    v-for="(item, index) in clientes.data"
                                    :key="item.id"
                                    class="list-complete-item"
                                >
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'clienteShow',
                                                params: { id: item.id }
                                            }"
                                            >{{ item.dni }}
                                        </router-link>
                                    </td>

                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'clienteShow',
                                                params: { id: item.id }
                                            }"
                                        >
                                            {{
                                                (item.nombre +
                                                    " " +
                                                    item.apellido)
                                                    | capitalize
                                            }}
                                        </router-link>
                                    </td>
                                    <td>{{ item.celular }}</td>
                                    <td>
                                        {{ item.domicilio | capitalize }}
                                    </td>
                                    <td>
                                        {{ item.profecion | capitalize }}
                                    </td>
                                    <td>
                                        {{ item.tipoFactura | capitalize }}
                                    </td>
                                    <td>
                                        <button
                                            class="btn"
                                            @click="clienteShow(item.id)"
                                        >
                                            <i class="fa fa-eye green"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            class="btn"
                                            @click="editModal(item)"
                                        >
                                            <i class="fa fa-edit blue"></i>
                                        </button>

                                        <delete
                                            :id="item.id"
                                            :index="index"
                                            :paginaActual="paginaActual"
                                            :search="search"
                                        />
                                    </td>
                                </tr>
                            </transition-group>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination
                            class="float-left"
                            :data="clientes"
                            :limit="2"
                            @pagination-change-page="getResults"
                        ></pagination>
                    </div>
                </div>
                <!-- /.card -->
                <ModalCliente
                    :paginaActual="paginaActual"
                    :search="search"
                    :form="form"
                    :facturas="facturas"
                    :editMode="editMode"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import Delete from "./ClienteDelete.vue";
import ModalCliente from "./clienteModal.vue";
export default {
    components: {
        Delete,
        ModalCliente
    },
    data() {
        return {
            //sirtve para mantener la pagina que se esta viendo al realizar las consultas
            paginaActual: 1,
            editMode: false,
            search: "",
            form: new Form({
                id: "",
                nombre: "",
                apellido: "",
                dni: "",
                facturas_id: "",
                celular: "",
                domicilio: "",
                profecion: ""
            })
        };
    },
    computed: {
        ...mapState("cliente", ["clientes"]),
        ...mapState("carga", ["facturas"])
    },
    mounted() {
        this.getResults(this.paginaActual);
        this.$Progress.finish();
    },

    methods: {
        clienteShow(clienteId) {
            this.$router.push({
                name: "clienteShow",
                params: { id: clienteId }
            });
        },

        editModal(cliente) {
            //abre el mismo modal pero con la opcion de edit modal en true lo que cambia a que metodo pasamos la info y rellena el modal
            this.editMode = true;
            this.$store.dispatch("carga/fetchAllFacturas");
            this.form.reset();
            $("#addEditCliente").modal("show");
            this.form.fill(cliente);
        },

        newModal() {
            //abre el modal, lo limpia y saca el modo de edicion si es que estaba activo
            this.editMode = false;
            this.$store.dispatch("carga/fetchAllFacturas");
            this.form.reset();
            $("#addEditCliente").modal("show");
        },

        //busca los clientes por pagina y por filtrado
        getResults(page) {
            //busca cualquier filtro que estemos usando y lo mantiene
            let query = this.search;
            //se actualiza la pagina actual con lo que nos da el metodo del componente de la paginacion
            this.paginaActual = page;
            //es la manera de pasar dos parametros al misma action
            let payload = { query: query, pagina: this.paginaActual };
            this.$store.dispatch("cliente/fetchClientes", payload);
        },
        //busca cada 50ms cada vez que se escribe una tecla
        buscar: _.debounce(function() {
            this.getResults();
        }, 50)
    }
};
</script>
