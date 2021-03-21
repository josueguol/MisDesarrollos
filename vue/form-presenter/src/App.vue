<template>
  <div>
    <header-menu></header-menu>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderMenu from './components/HeaderMenu.vue';

export default {
  components: {
    headerMenu: HeaderMenu
  }
};
</script>

<style>
</style>
