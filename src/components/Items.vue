<template>
<div>
  <b-overlay :show="show" rounded="sm">
  <b-card title="Datos de la opción de menú" :aria-hidden="show ? 'true' : null">
    <b-card bg-variant="light">
      <div>
        <b-form inline>
          <label class="sr-only" for="subMenu">Sub Menú</label>
          <b-input id="subMenu" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Ingrese Sub Menú" v-model="descripcion"></b-input>
          <label class="sr-only" for="precio">Precio</label>
          <b-input id="precio" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Ingrese Monto" v-model="precio"></b-input>
          <b-button variant="primary" @click='agregarSubItem'>Agregar</b-button>
        </b-form>
      </div>
    </b-card>
      <table class="table table-responsive table-bordered">
          <thead>
            <tr>
              <th hidden="true">id</th>                
              <th >Sub Menú</th>
              <th >Monto</th>
              <th >Accion</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="debt in products" :key="debt.id">
              <td hidden="true">
                  {{debt.id}} 
              </td>
              <td>
                {{debt.descripcion}} 
              </td>
              <td>
                  {{debt.precio}} 
              </td>
              <td class="text-right" hidden="true">
                  {{debt.id_tem }}
              </td>
              <td>
                  <input type="button" @click='deleteSubItem(debt.id)' value="Eliminar" class="btn-danger"/>
                </td>
            </tr>
          </tbody>
        </table>
    </b-card>
</b-overlay>
</div>
</template>

<script>
export default{
  name: 'Items',
        data () {
            return {
                descripcion: '',
                precio: '',
                products: [],
                show: false
            }
        },
        props: ['idMenu'],
        methods: {
            getAllSubMenu () {
            this.show = true
            this.$http.get('http://tidra.cl/menu/api/getSubMenuById.php?idItem=' + this.$props.idMenu, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then((response) => {
                 this.products = response.body
                 this.show = false
            }, (response) => {
                console.log(response)
            })
        },
        deleteSubItem (id) {
            let _this = this
            this.$http.get('http://tidra.cl/menu/api/deleteSubMenu.php?id=' + id, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then((response) => {
              _this.getAllSubMenu()
            })
        },
        agregarSubItem () {
          let _this = this
          this.show = true
          const formData = new FormData()
          formData.append('descripcion', this.descripcion)
          formData.append('precio', this.precio)
          formData.append('id_item', this.idMenu)
          this.$http.post('http://tidra.cl/menu/api/agregarSubMenu.php', formData)
          .then(function (response) {
            _this.getAllSubMenu()
            _this.descripcion = ''
            _this.precio = 0
            this.show = false
          })
          .catch(function (error) {
            console.log(error)
          })
          .then(function () {
          })
      }

    },
    mounted () {
      this.show = true
      this.$http.get('http://tidra.cl/menu/api/getSubMenuById.php?idItem=' + this.$props.idMenu)
        .then((response) => {
          this.products = response.body
          this.show = false
        }, (response) => {})
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
