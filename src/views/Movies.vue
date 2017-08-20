<template>
  <div class="content-wrapper py-3">
    <div class="container-fluid">

      <h1>Films</h1>
      <div class="movies-list">
        <div class="movie" v-for="item in movies">
          <img class="movie__image" v-bind:src="item.image" />
          <span class="movie__name">{{ item.title }}</span>
          <span class="movie__city">{{ item.description }}</span>
        </div>
      </div>
      
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import * as types from '../store/types';

export default {
  computed: mapGetters({
    movies: types.GET_MOVIE_LIST,
  }),
  created() {
    this.$store.dispatch(types.LOAD_MOVIE_LIST);
  },
};
</script>

