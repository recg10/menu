<template>
  <div id="app">
    
      <b-row>    
        <b-col cols="1" ><img src="./assets/logo.png" width="50" height="50"></b-col>
        <b-col cols="11"><h2>Menu Online</h2></b-col>
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
