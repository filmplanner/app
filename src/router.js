import Vue from 'vue';
import Router from 'vue-router';

import Planner from '@/views/Planner';
import Movies from '@/views/Movies';
import Theaters from '@/views/Theaters';

Vue.use(Router);

export default new Router({
  routes: [
    { path: '/', component: Planner },
    { path: '/films/actueel', component: Movies },
    { path: '/films/verwacht', component: Movies },
    { path: '/bioscopen', component: Theaters },
  ],
});
