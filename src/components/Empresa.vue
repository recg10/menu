<template>
<div>
  <b-overlay :show="show" rounded="sm"> 
  <notification v-bind:notifications="notifications"></notification>
  <b-card bg-variant="light" title="Datos de la empresa" :aria-hidden="show ? 'true' : null">
      <b-form-group
        label-cols-sm="3"
        label="Rut"
        label-align-sm="right"
        label-for="Rut"
        >
        <b-form-input id="Rut" type="number" v-model="rut" :state="rutState" :formatter="formatMaxNumber"></b-form-input>
      </b-form-group>

      <b-form-group
        label-cols-sm="3"
        label="Digito:"
        label-align-sm="right"
        label-for="Digito"
        
      >
        <b-form-input id="Digito" v-model="digito" :state="digitoState" :formatter="formatMaxDigito "></b-form-input>
      </b-form-group>

      <b-form-group
        label-cols-sm="3"
        label="Nombre:"
        label-align-sm="right"
        label-for="Nombre"
        
      >
        <b-form-input id="Nombre" v-model="nombre" :state="nameState"></b-form-input>
      </b-form-group>

      <b-form-group
        label-cols-sm="3"
        label="Email:"
        label-align-sm="right"
        label-for="Email"
        
      >
        <b-form-input id="Email" v-model="email" type="email" :state="emailState"></b-form-input>
      </b-form-group>

      <b-form-group
        label-cols-sm="3"
        label="Logo:"
        label-align-sm="right" class="mb-0">
        <div>
          <!-- Styled -->
         
          <b-form-file
            v-model="file"
            :state="Boolean(file)"
            placeholder="Seleccione un archivo aqui..."
            drop-placeholder="Drop file here..."
          ></b-form-file>
          
          <div class="mt-3">Archivo Seleccionado: {{ file ? file.name : '' }}</div>
         
        </div>
        <div class="form-group" tag="button">          
          <b-button id="saveEmpresa" pill variant="primary" @click="guardarEmpresa">Guardar Empresa</b-button>          
          <b-button  id="pasoEmpresa" pill variant="primary" class="btn btn-success" to="/menu">Continuar</b-button> 
          <b-tooltip target="saveEmpresa" triggers="hover">
            Guardar o actualizara todos los datos asociados a su  <b>Empresa</b> ahora!
          </b-tooltip>
          <b-tooltip target="pasoEmpresa" triggers="hover">
            Permite pasar al paso  <b>Siguiente</b> ahora!
          </b-tooltip>  
        </div>
      </b-form-group>     
  </b-card>
</b-overlay>
</div>
</template>

<script>
import Notification from './notifications.vue'
export default{
        data () {
            return {
                rut: '',
                digito: '',
                nombre: '',
                email: '',
                file: null,
                file2: null,
                notifications: [],
                show: false
            }
        },
        methods: {
        guardarEmpresa () {
          this.show = true
          this.notifications = []
          let rut = parseFloat(this.rut)
          if (isNaN(rut)) {
              this.notifications.push({
                  type: 'danger',
                  message: 'Debe ingresar solo numeros'
              })
              return false
          }
          const formData = new FormData()
          formData.append('rut', this.rut)
          formData.append('digito', this.digito)
          formData.append('nombre', this.nombre)
          formData.append('email', this.email)
          localStorage.rut = this.rut
          this.$http.post('http://tidra.cl/menu/api/agregarEmpresa.php', formData)
          .then(function (response) {
            console.log(response)
            this.notifications.push({
                type: 'success',
                message: 'Empresa almmacenada con exito'
            })
             this.show = false
          })
          .catch(function (error) {
            console.log(error)
            this.notifications.push({
                type: 'error',
                message: 'Error al almacenar'
            })
            this.show = false
          })
          .then(function () {
          })
      },
      formatMaxNumber (e) {
        return String(e).substring(0, 8)
      },
      formatMaxDigito (e) {
        return String(e).substring(0, 1)
      }

    },
    mounted () {
      this.show = true
      if (localStorage.rut) {
        this.rut = localStorage.rut
        this.$http.get('http://tidra.cl/menu/api/getEmpresaByRut.php?rut=' + this.rut).then((response) => {
           this.digito = response.body[0].digito
           this.email = response.body[0].email
           this.nombre = response.body[0].nombre
           this.file = response.body[0].file
           this.show = false
        }, (response) => {
          this.show = false
        })
      } else {
        this.show = false
      }
    },
    computed: {
      nameState () {
        let _resultado = false
        if (this.nombre.length > 2) {
          _resultado = true
        }
        return _resultado
      },
      digitoState () {
        let _resultado = false
        if (this.digito.length > 0) {
          _resultado = true
        }
        return _resultado
      },
      rutState () {
        let _resultado = false
        if (this.rut.length > 7) {
          _resultado = true
        }
        return _resultado
      },
      emailState () {
        let _resultado = false
        if (this.rut.length > 1) {
          _resultado = true
        }
        return _resultado
      }
    },
    components: {
            'notification': Notification
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
s