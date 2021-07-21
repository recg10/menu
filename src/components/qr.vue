<template>
  <b-overlay :show="show" rounded="sm">
  <b-card title="Imprimir Codigo QR" :aria-hidden="show ? 'true' : null">
    <div align="center">
      <b-card bg-variant="light" >  
        <div id="areaImpresion">
          <qr-code :text="this.rutaCompleta"></qr-code>
        </div>
      </b-card>
      <div class="form-group">    
        <b-button pill id="volverMenu" class="btn btn-danger" to="/menu">Volver</b-button>        
        <b-button pill id="imprimir" variant="primary" class="btn btn-success" @click='openWin()' >Imprimir</b-button>
        <!--
        <b-button pill id="finalizar" variant="primary" class="btn btn-success" >Finalizar</b-button>
        -->
        <!--<b-button pill  class="btn btn-danger" to="/">Volver</b-button> -->
        <!--
          <b-tooltip target="finalizar" triggers="hover">
            Permite <b>Finalizar y enviar mail con Código QR</b> para su impresion!!!
          </b-tooltip>
          -->
          <b-tooltip target="imprimir" triggers="hover">
            Permite <b>Imprimir Código QR</b>
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
          ruta: 'http://c4tic.cl/menu/api/getAllMenu.php?codigo=',
          rutaCompleta: '',
          show: false
      }
    },
    mounted () {
      this.rutaCompleta = this.ruta + btoa(localStorage.rut)
    },
    methods: {
      imprimir () {
        var contenido = document.getElementById('areaImpresion').innerHTML
        document.body.innerHTML = contenido
        window.print()
      },
      openWin () {
        var divText = document.getElementById('areaImpresion').outerHTML
        var myWindow = window.open('', '', 'width=500,height=500')
        var doc = myWindow.document
        doc.open()
        doc.write(divText)
        doc.write('<a href="javascript:window.print();">Imprimir</a><br/>')
        doc.write('<a href="javascript:window.close();;">Cerrar</a>')
        doc.close()
      }
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
