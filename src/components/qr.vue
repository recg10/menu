<template>
  <b-overlay :show="show" rounded="sm">
  <b-card title="Escanear Codigo QR" :aria-hidden="show ? 'true' : null">
    <div align="center">
      <b-card bg-variant="light" >  
      <qr-code :text="this.rutaCompleta"></qr-code>
      </b-card>
      <div class="form-group">    
        <b-button pill id="volverMenu" class="btn btn-danger" to="/menu">Volver</b-button>        
        <b-button pill id="finalizar" variant="primary" class="btn btn-success" >Finalizar</b-button>
        <!--<b-button pill  class="btn btn-danger" to="/">Volver</b-button> -->
        <b-tooltip target="finalizar" triggers="hover">
            Permite <b>Finalizar y enviar mail con Código QR</b> para su impresion!!!
          </b-tooltip>
          <b-tooltip target="volverMenu" triggers="hover">
            Permite <b>Volver</b> al paso anterior!
          </b-tooltip>  
      </div>      
    </div>
  </b-card>
</b-overlay>
</template>

<script>

export default {
  props: {
    msg: String
  },
  data () {
      return {
          ruta: 'http://tidra.cl/menu/api/getAllMenu.php?rut=',
          rutaCompleta: '',
          show: false
      }
    },
    mounted () {
      this.rutaCompleta = this.ruta + localStorage.rut
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
