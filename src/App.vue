<template>
  <div id="app">
    <navigation></navigation>
    <router-view></router-view>
    <modals></modals>
  </div>
</template>

<script>
import Navigation from './components/Navigation';
import Modals from './components/Modals';

export default {
  components: {
    Navigation,
    Modals,
  },
};
</script>

<style lang="scss">

body {
  background: #292b2c; 
  font-family: 'Roboto', sans-serif;
}

.content-wrapper {
  background: white; 
  margin-top: 62px;
  min-height: calc(100vh - 62px);
}

@media (min-width: 992px) {
  .content-wrapper {
    margin-left: 250px; 
  } 
}
</style>
