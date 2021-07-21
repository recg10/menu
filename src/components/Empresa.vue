<template>
<div align="center">
  <b-overlay :show="show" rounded="sm"> 
  <notification v-bind:notifications="notifications"></notification>
  <b-card bg-variant="light" 
   title="Datos de la empresa" :aria-hidden="show ? 'true' : null"  
   style="max-width: 90rem;"  class="rounded-0"
   img-left img-width="30%"
   :img-src="file2"   
   img-alt="Consultinc for Tencnology Infomatic and comunications">
   <b-card-text>
      Ingrese la información de su empresa o negocio
    </b-card-text>
   <b-row no-gutters>       
      <b-col sm="10">
        <b-form-input id="rut" size="lg" placeholder="Ingrese Rut Empresa" type="number"  v-model="rut" :state="rutState" :formatter="formatMaxNumber"></b-form-input>     
      </b-col>
      <b-col sm="2">
        <b-form-input id="digito" placeholder="Digito" size="lg" v-model="digito" :state="digitoState" :formatter="formatMaxDigito "></b-form-input>
      </b-col>
   </b-row>
      <b-form-input id="Nombre" placeholder="Ingrese Nombre de Empresa" size="lg" v-model="nombre" :state="nameState"></b-form-input>
     
      <b-form-input id="Email" placeholder="Ingrese Correo Electronico" size="lg" v-model="email" type="email" :state="emailState"></b-form-input>

        <div>
          <!-- Styled -->
         
          <b-form-file
            v-model="file"
            :state="Boolean(file)"
            placeholder="Seleccione un archivo para su fondo..."
            drop-placeholder="Drop file here..."
            size="lg"            
            accept=".jpg, .png, .gif"
            ></b-form-file>
          
          <div class="mt-3">Archivo Seleccionado : {{ file ? file.name : '' }}</div>
         
        </div>
        <div class="form-group" tag="button">          
          <b-button id="saveEmpresa" pill variant="primary" @click="guardarEmpresa">Guardar Empresa</b-button>          
          <b-button pill variant="primary" @click="submitFile">Cargar</b-button>
          <b-button  id="pasoEmpresa" pill variant="primary" class="btn btn-success" to="/menu">Continuar</b-button> 
          <b-tooltip target="saveEmpresa" triggers="hover">
            Guardar o actualizara todos los datos asociados a su  <b>Empresa</b> ahora!
          </b-tooltip>
          <b-tooltip target="pasoEmpresa" triggers="hover">
            Permite pasar al paso  <b>Siguiente</b> ahora!
          </b-tooltip>  
        </div>     
        <template #footer>
          <img src="http://c4tic.cl/img/logoc4tic.png" width="150" height="150"><br/>
          <em>Consultores <br/> Tecnologías Informáticas y de Comunicaciones <br/> Sitio Web http://c4tic.cl    <br/> Movil: +56 9 2217047</em>
        </template>    
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
        getEmpresa () {
          this.show = true
          if (localStorage.rut) {
            this.rut = localStorage.rut
            this.$http.get('http://c4tic.cl/menu/api/getEmpresaByRut.php?rut=' + this.rut).then((response) => {
              if (response.body.length > 0) {
                this.digito = response.body[0].digito
                this.email = response.body[0].email
                this.nombre = response.body[0].nombre
                this.file2 = response.body[0].logo
                if (this.file2 != null) {
                  this.file = new File([], this.file2)
                }
                this.show = false
              } else {
                this.show = false
              }
            }, (response) => {
              this.show = false
            })
          } else {
            this.show = false
          }
        },
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
          formData.append('logo', this.file.name)
          localStorage.rut = this.rut
          this.$http.post('http://c4tic.cl/menu/api/agregarEmpresa.php', formData)
          .then(function (response) {
            console.log(response)
            this.notifications.push({
                type: 'success',
                message: 'Empresa almmacenada con exito'
            })
             this.show = false
             this.getEmpresa()
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
      },
      submitFile () {
        this.show = true
        let formData = new FormData()
        formData.append('file', this.file)
        formData.append('rut', this.rut)
        this.$http.post('http://c4tic.cl/menu/api/upload.php', formData,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }).then(function (response) {
          console.log('SUCCESS!!')
          if (!response.data) {
              alert('File not uploaded.')
          } else {
              alert('Archivo cargadpo con exito, recuerde presionar el boton Guardar Empresa.')
          }
          this.show = false
        })
        .catch(function (error) {
          console.log(error)
        })
      }
    },
    mounted () {
      this.getEmpresa()
     },
    created () {
      console.log('created!')
    },
    beforeCreated () {
      console.log('beforeCreated!')
    },
    updated () {
      console.log('updated!')
    },
    detroyed () {
      console.log('detroyed!')
    },
    beforeDestroy () {
      console.log('beforeDestroy!!!')
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