<template>
  <div class="panel-body">
    <form>
      <vue-form-generator :schema="schema" :model="model" :options="formOptions"></vue-form-generator>
    </form>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";
import VueFormGenerator from "vue-form-generator";
import "vue-form-generator/dist/vfg.css";

Vue.use(VueFormGenerator);

export default {
  data() {
    return { data : "" }
  },
  methods: {
    getDocument() {
      axios({ method: "POST", "url": "https://localhost:5001/api/contenido", "data": this.input, "headers": { "content-type": "application/json" } }).then(result => {
          this.response = result.data;
      }, error => {
          console.error(error);
      });
    }
  }
};
</script>

<style>
</style>
