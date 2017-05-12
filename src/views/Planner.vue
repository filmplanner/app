<template>
  <div class="container-fluid">
    <h1>Plannen</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Bioscoop</th>
          <th>Stad</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in theaters">
          <td>{{item.name}}</td>
          <td>{{item.city}}</td>
          <td>{{item.image}}</td>
        </tr>
      </tbody>
    </table>
    <table class="table">
      <thead>
        <tr>
          <th>Film</th>
          <th>Beschrijving</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in movies">
          <td>{{item.title}}</td>
          <td>{{item.description}}</td>
          <td>{{item.image}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import * as types from '../store/types';

export default {
  computed: mapGetters({
    theaters: types.GET_THEATER_LIST,
    movies: types.GET_MOVIE_LIST,
  }),
  created() {
    this.$store.dispatch(types.LOAD_THEATER_LIST);
    this.$store.dispatch(types.LOAD_MOVIE_LIST);
  },
};
</script>
