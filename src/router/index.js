import Vue from 'vue';
import Router from 'vue-router';

import Home from '@/views/Home';
import Planner from '@/views/Planner';

Vue.use(Router);

export default new Router({
  routes: [
    { path: '/', component: Home },
    { path: '/planner', component: Planner },
  ],
});
