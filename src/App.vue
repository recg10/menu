<template>
  <div id="app">
      <b-row>    
        <b-col cols="2" >
            <img src="http://c4tic.cl/img/logoc4tic.png" width="120" height="120">
        </b-col>
        <b-col cols="8">
          <h1><p class="font-weight-bold">Menu Online</p></h1>
        </b-col>
        <b-col cols="2">
          <em>Consultores <br/> Tecnologías Informáticas y de Comunicaciones <br/> Sitio Web http://c4tic.cl <br/> Movil: +56 9 92217047</em>
        </b-col>
      </b-row>
      <b-row>    
        <b-col><router-view></router-view></b-col>    
      </b-row>
 
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 0px;
}
</style>
