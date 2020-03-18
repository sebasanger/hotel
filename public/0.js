(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ClienteComponent.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ClienteComponent.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      clientes: [],
      modoEditar: false,
      modoCrear: false,
      cliente: {
        id: "",
        nombre: "",
        appelldio: "",
        dni: "",
        telefono: "",
        celular: "",
        procedencia: "",
        destino: "",
        profecion: "",
        domicilio: ""
      },
      paginacion: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 1
    };
  },
  created: function created() {
    this.cargarClientes();
  },
  methods: {
    cargarClientes: function cargarClientes(page) {
      var _this = this;

      var urlClienjte = "cliente?page=" + page;
      axios.get(urlClienjte).then(function (res) {
        _this.clientes = res.data.data;
        _this.paginacion = res.data;
      });
    },
    agregar: function agregar() {
      var _this2 = this;

      if (this.cliente.nombre.trim() === "" || this.cliente.apellido.trim() === "" || this.cliente.dni.trim() === "") {
        swal("Faltan datos", "El dni, nombre y apellido son olbigatorios", "warning");
        return;
      }

      var clienteNuevo = this.cliente;
      axios.post("/cliente", clienteNuevo).then(function (res) {
        if (res.status === 201) {
          swal("Cliente creado", "Se creo correctamente el cliente", "success");
          var clienteCreado = res.data;

          _this2.cargarClientes();

          _this2.limpiar();

          _this2.cancelar();
        } else {
          swal("Cliente no creado", "No se puedo crear el cliente", "error");
        }
      });
    },
    editarFormulario: function editarFormulario(item) {
      this.cliente.nombre = item.nombre;
      this.cliente.apellido = item.apellido;
      this.cliente.dni = item.dni;
      this.cliente.celular = item.celular;
      this.cliente.profecion = item.profecion;
      this.cliente.domicilio = item.domicilio;
      this.cliente.procedencia = item.procedencia;
      this.cliente.destino = item.destino;
      this.cliente.id = item.id;
      this.modoEditar = true;
    },
    editarCliente: function editarCliente(cliente) {
      var _this3 = this;

      var params = {
        id: this.cliente.id,
        nombre: this.cliente.nombre,
        apellido: this.cliente.apellido,
        dni: this.cliente.dni,
        profecion: this.cliente.profecion,
        celular: this.cliente.celular,
        procedencia: this.cliente.procedencia,
        domicilio: this.cliente.domicilio,
        destino: this.cliente.destino
      };
      axios.put("/cliente/".concat(cliente.id), params).then(function (res) {
        if (res.status === 200) {
          _this3.modoEditar = false;

          var index = _this3.clientes.findIndex(function (item) {
            return item.id === cliente.id;
          });

          _this3.clientes[index] = res.data;

          _this3.limpiar();

          swal("Cliente editado", "Cliente actualizado correctamente", "success");
        } else {
          swal("Cliente no editado", "No se puedo editar el cliente", "error");
        }
      });
    },
    eliminarCliente: function eliminarCliente(cliente, index) {
      var _this4 = this;

      swal({
        title: "¿Esta seguro que desea eliminar el cliente?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(function (willDelete) {
        if (willDelete) {
          axios["delete"]("/cliente/".concat(cliente.id)).then(function (res) {
            console.log(res);

            if (res.status === 200) {
              _this4.clientes.splice(index, 1);
            } else {
              alert("No se pudo eliminar el cliente");
            }
          });
          swal("Cliente eliminado correctamente", {
            icon: "success"
          });
        } else {
          swal("No se pudo eliminar el cliente", {
            icon: "error"
          });
        }
      });
    },
    cancelar: function cancelar() {
      this.modoEditar = false;
      this.modoCrear = false;
      this.limpiar();
    },
    limpiar: function limpiar() {
      this.cliente = {
        id: "",
        nombre: "",
        appelldio: "",
        dni: "",
        profecion: "",
        telefono: "",
        celular: "",
        procedencia: "",
        destino: "",
        domicilio: ""
      };
    },
    modoAgregar: function modoAgregar() {
      this.modoCrear = true;
    },
    changePage: function changePage(page) {
      this.paginacion.current_page = page;
      this.cargarClientes(page);
    }
  },
  computed: {
    isActived: function isActived() {
      return this.paginacion.current_page;
    },
    pagesNumber: function pagesNumber() {
      if (!this.paginacion.to) {
        return [];
      }

      var from = this.paginacion.current_page - this.offset;

      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset;

      if (to < this.paginacion.last_page) {
        to = this.paginacion.last_page;
      }

      var pagesArray = [];

      while (from <= to) {
        pagesArray.push(from);
        from++;
      }

      return pagesArray;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ClienteComponent.vue?vue&type=template&id=6155990e&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ClienteComponent.vue?vue&type=template&id=6155990e& ***!
  \*******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.modoEditar && !_vm.modoCrear
      ? _c(
          "form",
          {
            staticClass: "col-md-8",
            on: {
              submit: function($event) {
                $event.preventDefault()
                return _vm.editarCliente(_vm.cliente)
              }
            }
          },
          [
            _c("h3", [_vm._v("Editar cliente")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.nombre,
                  expression: "cliente.nombre"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", required: "", placeholder: "Nombre" },
              domProps: { value: _vm.cliente.nombre },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "nombre", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.apellido,
                  expression: "cliente.apellido"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Apellido", required: "" },
              domProps: { value: _vm.cliente.apellido },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "apellido", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.dni,
                  expression: "cliente.dni"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "number", placeholder: "Documento", required: "" },
              domProps: { value: _vm.cliente.dni },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "dni", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.celular,
                  expression: "cliente.celular"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "number", placeholder: "celular" },
              domProps: { value: _vm.cliente.celular },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "celular", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.procedencia,
                  expression: "cliente.procedencia"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Procedencia" },
              domProps: { value: _vm.cliente.procedencia },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "procedencia", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.domicilio,
                  expression: "cliente.domicilio"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Domicilio" },
              domProps: { value: _vm.cliente.domicilio },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "domicilio", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.destino,
                  expression: "cliente.destino"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Destino" },
              domProps: { value: _vm.cliente.destino },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "destino", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.profecion,
                  expression: "cliente.profecion"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Profecion" },
              domProps: { value: _vm.cliente.profecion },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "profecion", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c(
              "button",
              { staticClass: "btn btn-warning", attrs: { type: "submit" } },
              [_vm._v("Editar")]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-danger",
                attrs: { type: "submit" },
                on: { click: _vm.cancelar }
              },
              [_vm._v("Cancelar")]
            )
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    !_vm.modoEditar && _vm.modoCrear
      ? _c(
          "form",
          {
            on: {
              submit: function($event) {
                $event.preventDefault()
                return _vm.agregar($event)
              }
            }
          },
          [
            _c("h3", [_vm._v("Agregar cliente")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.nombre,
                  expression: "cliente.nombre"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", required: "", placeholder: "Nombre" },
              domProps: { value: _vm.cliente.nombre },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "nombre", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.apellido,
                  expression: "cliente.apellido"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Apellido", required: "" },
              domProps: { value: _vm.cliente.apellido },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "apellido", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.dni,
                  expression: "cliente.dni"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "number", placeholder: "Documento", required: "" },
              domProps: { value: _vm.cliente.dni },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "dni", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.celular,
                  expression: "cliente.celular"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "number", placeholder: "celular" },
              domProps: { value: _vm.cliente.celular },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "celular", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.procedencia,
                  expression: "cliente.procedencia"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Procedencia" },
              domProps: { value: _vm.cliente.procedencia },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "procedencia", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.domicilio,
                  expression: "cliente.domicilio"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Domicilio" },
              domProps: { value: _vm.cliente.domicilio },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "domicilio", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.destino,
                  expression: "cliente.destino"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Destino" },
              domProps: { value: _vm.cliente.destino },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "destino", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.cliente.profecion,
                  expression: "cliente.profecion"
                }
              ],
              staticClass: "form-control mb-2",
              attrs: { type: "text", placeholder: "Profecion" },
              domProps: { value: _vm.cliente.profecion },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.cliente, "profecion", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-primary btn-success",
                attrs: { type: "submit" }
              },
              [_vm._v("Agregar")]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-danger",
                attrs: { type: "submit" },
                on: { click: _vm.cancelar }
              },
              [_vm._v("Cancelar")]
            )
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    !_vm.modoCrear && !_vm.modoEditar
      ? _c(
          "button",
          { staticClass: "btn btn-info mb-2", on: { click: _vm.modoAgregar } },
          [_vm._v("Agregar nuevo")]
        )
      : _vm._e(),
    _vm._v(" "),
    !_vm.modoCrear && !_vm.modoEditar
      ? _c(
          "table",
          {
            staticClass: "table table-striped table-hover table-dark col-md-12"
          },
          [
            _vm._m(0),
            _vm._v(" "),
            _c(
              "tbody",
              _vm._l(_vm.clientes, function(item, index) {
                return _c("tr", { key: index }, [
                  _c("td", [_vm._v(_vm._s(item.nombre))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.apellido))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.dni))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.celular))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.procedencia))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.domicilio))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.destino))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.profecion))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.created_at))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(item.updated_at))]),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-warning btn-sm mt-2",
                      on: {
                        click: function($event) {
                          return _vm.editarFormulario(item)
                        }
                      }
                    },
                    [_vm._v("Editar")]
                  ),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-danger btn-sm ml-1 mt-2",
                      on: {
                        click: function($event) {
                          return _vm.eliminarCliente(item, index)
                        }
                      }
                    },
                    [_vm._v("X")]
                  )
                ])
              }),
              0
            )
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    !_vm.modoCrear && !_vm.modoEditar
      ? _c(
          "ul",
          { staticClass: "pagination" },
          [
            _vm.paginacion.current_page > 1
              ? _c("li", { staticClass: "page-item" }, [
                  _c(
                    "a",
                    {
                      staticClass: "page-link",
                      attrs: { href: "#" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          return _vm.changePage(_vm.paginacion.current_page - 1)
                        }
                      }
                    },
                    [_c("span", [_vm._v("Atras")])]
                  )
                ])
              : _vm._e(),
            _vm._v(" "),
            _vm._l(_vm.pagesNumber, function(page) {
              return _c(
                "li",
                {
                  key: page.id,
                  staticClass: "page-item",
                  class: [page == _vm.isActived ? "active" : ""]
                },
                [
                  _c(
                    "a",
                    {
                      staticClass: "page-link",
                      attrs: { href: "#" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          return _vm.changePage(page)
                        }
                      }
                    },
                    [_c("span", [_vm._v(_vm._s(page))])]
                  )
                ]
              )
            }),
            _vm._v(" "),
            _vm.paginacion.current_page < _vm.paginacion.last_page
              ? _c("li", { staticClass: "page-item" }, [
                  _c(
                    "a",
                    {
                      staticClass: "page-link",
                      attrs: { href: "#" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          return _vm.changePage(_vm.paginacion.current_page + 1)
                        }
                      }
                    },
                    [_c("span", [_vm._v("Siguiente")])]
                  )
                ])
              : _vm._e()
          ],
          2
        )
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Nombre")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Apellido")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("dni")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Celular")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Procedencia")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Domicilio")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Destino")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Profecion")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Agregado")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Modificado")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Acciones")])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/ClienteComponent.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/ClienteComponent.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ClienteComponent_vue_vue_type_template_id_6155990e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ClienteComponent.vue?vue&type=template&id=6155990e& */ "./resources/js/components/ClienteComponent.vue?vue&type=template&id=6155990e&");
/* harmony import */ var _ClienteComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ClienteComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/ClienteComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ClienteComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ClienteComponent_vue_vue_type_template_id_6155990e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ClienteComponent_vue_vue_type_template_id_6155990e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ClienteComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ClienteComponent.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/ClienteComponent.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ClienteComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ClienteComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ClienteComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ClienteComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ClienteComponent.vue?vue&type=template&id=6155990e&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/ClienteComponent.vue?vue&type=template&id=6155990e& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClienteComponent_vue_vue_type_template_id_6155990e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ClienteComponent.vue?vue&type=template&id=6155990e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ClienteComponent.vue?vue&type=template&id=6155990e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClienteComponent_vue_vue_type_template_id_6155990e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClienteComponent_vue_vue_type_template_id_6155990e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);