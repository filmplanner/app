import Vue from 'vue';
import Router from 'vue-router';

import Planner from '@/views/Planner';
import Films from '@/views/Films';

Vue.use(Router);

export default new Router({
  routes: [
    { path: '/', component: Planner },
    { path: '/films', component: Films },
  ],
});
