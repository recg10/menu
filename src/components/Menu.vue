<template>
<div>
  <b-card bg-variant="light">
    <b-form inline>
    <label class="sr-only" for="menu">Ingrese Menu</label>
    <b-input
      id="descripcion"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="Ingrese Menu" v-model="descripcion"></b-input>     
    <b-button id="creaMenu" pill variant="primary"  @click='agregarMenu' >Crear Menu</b-button>    
    <b-button id="volverMenu" pill to="/" class="btn btn-danger" >Volver</b-button>
    <b-button id="siguienteMenu" pill to="/qr" class="btn btn-success">Ir Paso Final</b-button>
    <b-tooltip target="creaMenu" triggers="hover">
      Permite  <b>Crear Menu</b> en el listado de menu
    </b-tooltip>
    <b-tooltip target="volverMenu" triggers="hover">
      Permite <b>Volver</b>   ahora!
    </b-tooltip>
    <b-tooltip target="siguienteMenu" triggers="hover">
      Permite pasar al paso  <b>Siguiente</b> ahora!
    </b-tooltip> 


    </b-form>        
  </b-card>
  <div role="tablist">    
    <b-card v-for="(debt) in products" no-body class="mb-1" :key="debt.id">
      <b-card-header header-tag="header" class="p-1" role="tab">
        <b-button block v-b-toggle="'accordion-'+debt.id" variant="info">{{debt.descripcion}}</b-button>
      </b-card-header>
      <b-collapse :id="'accordion-'+debt.id" visible accordion="my-accordion" role="tabpanel">
        <b-card-body>          
          <Items :idMenu=debt.id />
        </b-card-body>
      </b-collapse>
    </b-card>
  </div>
</div>
</template>

<script>
import Items from '@/components/Items.vue'
export default{
        data () {
            return {
                descripcion: '',
                precio: '',
                products: []
            }
        },
        components: {
          Items
        },
        methods: {
            getAllMenu () {
            this.$http.get('http://tidra.cl/menu/api/getMenuByRutEmpresa.php?rutEmpresa=' + this.rut, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then((response) => {
                 this.products = response.body
            }, (response) => {
                console.log(response)
            })
        },
        deleteItem (id) {
            let _this = this
            this.$http.get('http://tidra.cl/menu/api/deleteMenu.php?id=' + id, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then((response) => {
              _this.getAllSubMenu()
            })
        },
        agregarMenu () {
          let _this = this
          const formData = new FormData()
          this.rut = localStorage.rut
          formData.append('descripcion', this.descripcion)
          formData.append('rutEmpresa', this.rut)
          this.$http.post('http://tidra.cl/menu/api/agregarMenu.php', formData)
          .then(function (response) {
            _this.getAllMenu()
            _this.descripcion = ''
          })
          .catch(function (error) {
            console.log(error)
          })
          .then(function () {
          })
      }

    },
    mounted () {
      this.rut = localStorage.rut
      this.$http.get('http://tidra.cl/menu/api/getMenuByRutEmpresa.php?rutEmpresa=' + this.rut).then((response) => {
            this.products = response.body
        }, (response) => {
      })
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
