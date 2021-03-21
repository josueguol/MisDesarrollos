import Vue from 'vue';
import Vuex from 'vuex';

import { mutations, STORAGE_KEY } from './mutations'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    todos: JSON.parse(window.localStorage.getItem(STORAGE_KEY) || '[]')
  },
  mutations
});