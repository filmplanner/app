import Vue from 'vue';
import Vuex from 'vuex';
import createLogger from 'vuex/dist/logger';
import * as actions from './actions';
import * as mutations from './mutations';
import * as getters from './getters';

import planner from './modules/planner';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

const store = new Vuex.Store({
  actions,
  mutations,
  getters,
  modules: {
    planner,
  },
  strict: debug,
  plugins: debug ? [createLogger()] : [],
});

export default store;
