<template>
    <div>
        <form
            @submit.prevent="editarNota(cliente)"
            v-if="modoEditar && !modoCrear"
            class="col-md-8"
        >
            <h3>Editar nota</h3>
            <input
                type="text"
                class="form-control mb-2"
                placeholder="Nombre"
                v-model="cliente.nombre"
            />
            <input
                type="text"
                class="form-control mb-2"
                placeholder="Apellido"
                v-model="cliente.apellido"
            />
            <input
                type="number"
                class="form-control mb-2"
                placeholder="Documento"
                v-model="cliente.dni"
            />
            <input
                type="email"
                class="form-control mb-2"
                placeholder="Email"
                v-model="cliente.email"
            />
            <input
                type="number"
                class="form-control mb-2"
                placeholder="celular"
                v-model="cliente.celular"
            />
            <button class="btn btn-warning" type="submit">Editar</button>
            <button
                class="btn btn-danger"
                type="submit"
                @click="cancelarEdicion"
            >
                Cancelar
            </button>
        </form>

        <form @submit.prevent="agregar" v-if="!modoEditar && modoCrear">
            <h3>Agregar cliente</h3>
            <input
                type="text"
                class="form-control mb-2"
                required
                placeholder="Nombre"
                v-model="cliente.nombre"
            />
            <input
                type="text"
                class="form-control mb-2"
                placeholder="Apellido"
                required
                v-model="cliente.apellido"
            />
            <input
                type="number"
                class="form-control mb-2"
                placeholder="Documento"
                required
                v-model="cliente.dni"
            />
            <input
                type="email"
                class="form-control mb-2"
                placeholder="Email"
                v-model="cliente.email"
            />
            <input
                type="number"
                class="form-control mb-2"
                placeholder="celular"
                v-model="cliente.celular"
            />
            <button class="btn btn-primary btn-success" type="submit">
                Agregar
            </button>
        </form>

        <button
            class="btn btn-info mb-2"
            @click="modoAgregar"
            v-if="!modoCrear && !modoEditar"
        >
            Agregar nuevo
        </button>
        <table
            class="table table-striped table-dark"
            v-if="!modoCrear && !modoEditar"
        >
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">dni</th>
                    <th scope="col">email</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in clientes" :key="index">
                    <td>{{ item.nombre }}</td>
                    <td>{{ item.apellido }}</td>
                    <td>{{ item.dni }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.celular }}</td>

                    <button
                        class="btn btn-warning btn-sm mt-2"
                        @click="editarFormulario(item)"
                    >
                        Editar
                    </button>
                    <button
                        class="btn btn-danger btn-sm ml-2 mt-2"
                        @click="eliminarNota(item, index)"
                    >
                        Eliminar
                    </button>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            clientes: [],
            modoEditar: false,
            modoCrear: false,
            cliente: {
                id: "",
                nombre: "",
                appelldio: "",
                dni: "",
                email: "",
                telefono: "",
                celular: ""
            }
        };
    },
    created() {
        axios.get("/cliente").then(res => {
            this.clientes = res.data;
        });
    },
    methods: {
        agregar() {
            if (
                this.cliente.nombre.trim() === "" ||
                this.cliente.apellido.trim() === "" ||
                this.cliente.dni.trim() === ""
            ) {
                alert("El nombre, appellido y dni son obligatorios");
                return;
            }
            const clienteNuevo = this.cliente;

            axios.post("/cliente", clienteNuevo).then(res => {
                if (res.status === 201) {
                    const clienteCreado = res.data;
                    this.clientes.push(clienteCreado);
                    alert("Cliente creado");
                    this.limpiar();
                    this.modoCrear = false;
                    axios.get("/cliente").then(res => {
                        this.clientes = res.data;
                    });
                } else {
                    alert("No se pudo crear el cliente");
                }
            });
        },
        editarFormulario(item) {
            this.cliente.nombre = item.nombre;
            this.cliente.apellido = item.apellido;
            this.cliente.dni = item.dni;
            this.cliente.celular = item.celular;
            this.cliente.email = item.email;
            this.cliente.id = item.id;
            this.modoEditar = true;
        },
        editarNota(cliente) {
            const params = {
                id: this.cliente.id,
                nombre: this.cliente.nombre,
                apellido: this.cliente.apellido,
                dni: this.cliente.dni,
                email: this.cliente.email,
                celular: this.cliente.celular
            };
            axios.put(`/cliente/${cliente.id}`, params).then(res => {
                if (res.status === 200) {
                    alert("Cliente editado correctamente");
                    this.modoEditar = false;
                    const index = this.clientes.findIndex(
                        item => item.id === cliente.id
                    );
                    this.clientes[index] = res.data;
                    this.limpiar();
                } else {
                    alert("Error, no se pudo crear el cliente");
                }
            });
        },
        eliminarNota(cliente, index) {
            const confirmacion = confirm(
                `¿Esta seguro desea eliminar al cliente ${cliente.nombre} ${cliente.apellido}?`
            );
            if (confirmacion) {
                axios.delete(`/cliente/${cliente.id}`).then(res => {
                    console.log(res);
                    if (res.status === 200) {
                        this.clientes.splice(index, 1);
                        alert("Cliente eliminado");
                    } else {
                        alert("No se pudo eliminar el cliente");
                    }
                });
            }
        },
        cancelarEdicion() {
            this.modoEditar = false;
            this.limpiar();
        },
        limpiar() {
            this.cliente = {
                nombre: "",
                apellido: "",
                dni: "",
                telefono: "",
                celular: "",
                email: ""
            };
        },
        modoAgregar() {
            this.modoCrear = true;
        }
    }
};
</script>
