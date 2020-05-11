<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="addNew"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addNew"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="addNew"
                            v-text="
                                editMode
                                    ? 'Editar habitacion'
                                    : 'Crear habitacion'
                            "
                        ></h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        enctype="multipart/form-data"
                        @submit.prevent="
                            editMode ? updateHabitacion() : createHabitacion()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Numero de habitacion</label>
                                <input
                                    v-model="form.numeroHabitacion"
                                    type="number"
                                    name="numeroHabitacion"
                                    required
                                    placeholder="Numero de habitacion"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'numeroHabitacion'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="numeroHabitacion"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Piso de la habitacion</label>
                                <select
                                    v-model="form.piso"
                                    name="piso"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('piso')
                                    }"
                                >
                                    <option value>Seleccionar la planta</option>
                                    <option value="1">Primera planta</option>
                                    <option value="2">Segunda planta</option>
                                    <option value="3">Tercera planta</option>
                                    <option value="4">Cuarta planta</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="piso"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Capacidad maxima de la habitacion</label>
                                <select
                                    v-model="form.capacidad"
                                    name="capacidad"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'capacidad'
                                        )
                                    }"
                                >
                                    <option value
                                        >Seleccionar la capacidad maxima</option
                                    >
                                    <option value="1">Una persona</option>
                                    <option value="2">Dos personas</option>
                                    <option value="3">Tres personas</option>
                                    <option value="4">Cuatro personas</option>
                                    <option value="5">Cinco personas</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="capacidad"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Cantidad de camas singles</label>
                                <select
                                    v-model="form.single"
                                    name="single"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('single')
                                    }"
                                >
                                    <option value
                                        >Seleccionar la cantidad de camas
                                        singles</option
                                    >
                                    <option value="1">Una</option>
                                    <option value="2">Dos</option>
                                    <option value="3">Tres</option>
                                    <option value="4">Cuatro</option>
                                    <option value="5">Cinco</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="single"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Cantidad de camas matrimoñales</label>
                                <select
                                    v-model="form.doble"
                                    name="doble"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('doble')
                                    }"
                                >
                                    <option value
                                        >Seleccionar la cantidad de camas
                                        matrimoñales</option
                                    >
                                    <option value="1">Una</option>
                                    <option value="2">Dos</option>
                                    <option value="3">Tres</option>
                                    <option value="4">Cuatro</option>
                                    <option value="5">Cinco</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="doble"
                                ></has-error>
                            </div>

                            <div class="form-group" v-show="editMode">
                                <label>Estado</label>
                                <select
                                    v-model="form.estado"
                                    name="estado"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('estado')
                                    }"
                                >
                                    <option value
                                        >Seleccionar el estado de la
                                        habitacion</option
                                    >
                                    <option value="1">Disponible</option>
                                    <option value="2">Ocupada</option>
                                    <option value="3">Limpiar</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="estado"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Imagen de la habitacion</label>
                                <input
                                    @change="obtenerImagen"
                                    type="file"
                                    accept="image/*"
                                    name="image_path"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'image_path'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="image_path"
                                ></has-error>
                                <div class="imagenes">
                                    <figure v-if="imagenMiniatrua">
                                        <img
                                            :src="imagenMiniatrua"
                                            width="250"
                                            height="150"
                                        />
                                    </figure>
                                    <figure v-else-if="form.image_path">
                                        <img
                                            :src="getFoto()"
                                            width="250"
                                            height="150"
                                        />
                                    </figure>
                                    <div v-else class="preview">
                                        <p>
                                            No hay ninguna imagen aún
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" v-if="form.image_path">
                                <label>Segunda imagen de la habitacion</label>
                                <input
                                    @change="obtenerImagen2"
                                    type="file"
                                    accept="image/*"
                                    name="image_path2"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'image_path2'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="image_path2"
                                ></has-error>
                                <div class="imagenes">
                                    <figure v-if="imagenMiniatrua2">
                                        <img
                                            :src="imagenMiniatrua2"
                                            width="250"
                                            height="150"
                                        />
                                    </figure>
                                    <figure v-else-if="form.image_path2">
                                        <img
                                            :src="getFoto2()"
                                            width="250"
                                            height="150"
                                        />
                                    </figure>
                                    <div v-else class="preview">
                                        <p>
                                            No hay ninguna imagen aún
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" v-if="form.image_path2">
                                <label>Terecera imagen de la habitacion</label>
                                <input
                                    @change="obtenerImagen3"
                                    type="file"
                                    accept="image/*"
                                    name="image_path3"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'image_path3'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="image_path3"
                                ></has-error>
                                <div class="imagenes">
                                    <figure v-if="imagenMiniatrua3">
                                        <img
                                            :src="imagenMiniatrua3"
                                            width="250"
                                            height="150"
                                        />
                                    </figure>
                                    <figure v-else-if="form.image_path3">
                                        <img
                                            :src="getFoto3()"
                                            width="250"
                                            height="150"
                                        />
                                    </figure>
                                    <div v-else class="preview">
                                        <p>
                                            No hay ninguna imagen aún
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Cancelar
                            </button>
                            <button
                                v-if="!editMode"
                                type="submit"
                                class="btn btn-success"
                            >
                                Guardar
                            </button>
                            <button
                                v-if="editMode"
                                type="submit"
                                class="btn btn-success"
                            >
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["form", "editMode"],
    data() {
        return {
            imagenMiniatrua: "",
            imagenMiniatrua2: "",
            imagenMiniatrua3: ""
        };
    },

    methods: {
        updateHabitacion() {
            this.$Progress.start();
            this.form
                .put("habitacion/" + this.form.id)
                .then(res => {
                    this.imagenMiniatrua = "";
                    this.imagenMiniatrua2 = "";
                    this.imagenMiniatrua3 = "";
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Habitacion actualizada correctamente"
                    });
                    this.$Progress.finish();
                    this.getResults();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        createHabitacion() {
            this.$Progress.start();
            this.imagenMiniatrua = "";
            this.imagenMiniatrua2 = "";
            this.imagenMiniatrua3 = "";
            this.form
                .post("habitacion")
                .then(() => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "habitacion creada correctamente"
                    });
                    this.$Progress.finish();
                    this.getResults();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        getResults() {
            this.$store.dispatch("habitacion/fetchHabitaciones");
        },

        obtenerImagen(e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            if (file["size"] < 2111775) {
                reader.onloadend = event => {
                    this.imagenMiniatrua = event.target.result;
                    this.form.image_path = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                Swal.fire(
                    "Error!",
                    "La imagen 1 no puede tener mas que 2 mb",
                    "error"
                );
            }
        },
        getFoto() {
            if (this.form.image_path) {
                return "img/habitaciones/" + this.form.image_path;
            }
        },

        obtenerImagen2(e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            if (file["size"] < 2111775) {
                reader.onloadend = event => {
                    this.imagenMiniatrua2 = event.target.result;
                    this.form.image_path2 = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                Swal.fire(
                    "Error!",
                    "La imagen 2 no puede tener mas que 2 mb",
                    "error"
                );
            }
        },
        getFoto2() {
            if (this.form.image_path2) {
                return "img/habitaciones/" + this.form.image_path2;
            }
        },

        obtenerImagen3(e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            if (file["size"] < 2111775) {
                reader.onloadend = event => {
                    this.imagenMiniatrua3 = event.target.result;
                    this.form.image_path3 = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                Swal.fire(
                    "Error!",
                    "La imagen 3 no puede tener mas que 2 mb",
                    "error"
                );
            }
        },
        getFoto3() {
            if (this.form.image_path3) {
                return "img/habitaciones/" + this.form.image_path3;
            }
        }
    }
};
</script>

<style scoped>
.imagenes {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    margin-top: 5px;
}
</style>
