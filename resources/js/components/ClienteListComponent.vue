<template>
    <div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre y apellido</th>
                        <th>Celular</th>
                        <th>Domicio</th>
                        <th>Destino</th>
                        <th>Procedencia</th>
                        <th>Profecion</th>
                        <th>Factura</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <transition-group tag="tbody" name="fade-list">
                    <tr
                        v-for="item in clientes.cliente.data"
                        :key="item.id"
                        class="list-complete-item"
                    >
                        <td>{{ item.dni }}</td>
                        <td>
                            {{
                                (item.nombre + " " + item.apellido) | capitalize
                            }}
                        </td>
                        <td>{{ item.celular }}</td>
                        <td>
                            {{ item.domicilio | capitalize }}
                        </td>
                        <td>{{ item.destino | capitalize }}</td>
                        <td>
                            {{ item.procedencia | capitalize }}
                        </td>
                        <td>
                            {{ item.profecion | capitalize }}
                        </td>
                        <td>
                            {{ item.tipoFactura | capitalize }}
                        </td>
                        <td>
                            <button @click="editModal(item)" class="btn">
                                <i class="fa fa-edit blue"></i>
                            </button>
                            |
                            <button class="btn" @click="deleteCliente(item.id)">
                                <i class="fa fa-trash red"></i>
                            </button>
                        </td>
                    </tr>
                </transition-group>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</template>

<script>
export default {
    props: ["clientes"]
};
</script>
