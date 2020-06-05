<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button
                            class="btn-info text-white float-right"
                            @click="newModal"
                        >
                            Agregar habitacion
                        </button>
                        <h5>Habitaciones</h5>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table
                            class="table table-bordered table-hover dataTable"
                        >
                            <thead>
                                <tr>
                                    <th>N° Habitacion</th>
                                    <th>Piso</th>
                                    <th>Capacidad maxima</th>
                                    <th>Camas Singles</th>
                                    <th>Camas Matrimoñales</th>
                                    <th>Cambiar estado</th>
                                    <th>Estado</th>
                                    <th>Fotos</th>
                                    <th v-show="user.role == 1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr
                                    v-for="item in habitacionesReales"
                                    :key="item.id"
                                >
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'habitacionShow',
                                                params: { id: item.id }
                                            }"
                                            >{{ item.numeroHabitacion }}
                                        </router-link>
                                    </td>
                                    <td>{{ item.piso | piso }}</td>
                                    <td>{{ item.capacidad | capacidad }}</td>
                                    <td>
                                        <i
                                            v-for="(cs, index) in item.single"
                                            :key="index"
                                            class="fa fa-bed red ml-1"
                                        ></i>
                                    </td>
                                    <td>
                                        <i
                                            v-for="(cd, index) in item.doble"
                                            :key="index"
                                            class="fa fa-bed blue ml-1"
                                        ></i>
                                    </td>
                                    <td>
                                        <select
                                            name="estado"
                                            class="form-control"
                                            @change="
                                                cambiarEstado(item.id, $event)
                                            "
                                        >
                                            <option value disabled selected
                                                >Cambiar estado</option
                                            >
                                            <option value="1" class="bg-green"
                                                >Disponible</option
                                            >
                                            <option class="bg-red" value="2"
                                                >Ocupada</option
                                            >
                                            <option class="bg-yellow" value="3"
                                                >Limpiar</option
                                            >
                                        </select>
                                    </td>
                                    <td
                                        :style="[
                                            item.estado == 2 ? ocupada : '',
                                            item.estado == 1 ? disponible : '',
                                            item.estado == 3 ? limpieza : ''
                                        ]"
                                    >
                                        {{ item.estado | estado }}
                                    </td>

                                    <td>
                                        <button
                                            v-if="
                                                item.image_path ||
                                                    item.image_path2 ||
                                                    item.image_path3
                                            "
                                            @click="galery(item.id)"
                                            class="btn btn-block"
                                        >
                                            <i class="fa fa-image orange"></i>
                                        </button>
                                    </td>
                                    <td
                                        class="text-center"
                                        v-show="user.role == 1"
                                    >
                                        <button
                                            @click="editModal(item)"
                                            class="btn"
                                        >
                                            <i class="fa fa-edit blue"></i>
                                        </button>

                                        <delete :id="item.id" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <ModalHabitacion :form="form" :editMode="editMode" />
        <galeryModal />
    </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import Delete from "./habitacionDelete.vue";
import ModalHabitacion from "./HabitacionModal.vue";
import galeryModal from "./galeryModal.vue";
export default {
    components: {
        Delete,
        ModalHabitacion,
        galeryModal
    },
    data() {
        return {
            ocupada: {
                background: "#ffcccc"
            },
            disponible: {
                background: "#ccffcc"
            },
            limpieza: {
                background: "#ffffcc"
            },
            editMode: false,
            form: new Form({
                id: "",
                numeroHabitacion: "",
                capacidad: "",
                piso: "",
                single: "",
                doble: "",
                image_path: "",
                image_path2: "",
                image_path3: "",
                estado: ""
            })
        };
    },

    computed: {
        ...mapGetters("habitacion", ["habitacionesReales"]),
        ...mapState("user", ["user"])
    },
    methods: {
        cambiarEstado(id, event) {
            this.$Progress.start();
            axios
                .get("/cambiarEstado/" + id + "/" + event.target.value)
                .then(() => {
                    this.$store.dispatch("habitacion/fetchHabitaciones");

                    Swal.fire(
                        "Listo!",
                        "Se finalizo cambio el estado de la habitacion correctamente",
                        "success"
                    );
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Swal.fire(
                        "Listo!",
                        "No se pudo cambiar el estado de la habitacion",
                        "error"
                    );
                });
        },
        newModal() {
            this.editMode = false;
            this.form.reset();
            $("#addNew").modal("show");
        },

        editModal(habitacion) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(habitacion);
        },

        galery(id) {
            this.$store
                .dispatch("habitacion/fetchHabitacion", id)
                .then(() => {
                    $("#galery").modal("show");
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        }
    },
    mounted() {
        this.$store.dispatch("habitacion/fetchHabitaciones");
        this.$Progress.finish();
    }
};
</script>
