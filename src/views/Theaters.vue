<template>
  <div class="content-wrapper py-3">
    <div class="container-fluid">

      <h1>Bioscopen</h1>
      <div class="theaters-list">
        <div class="theater" v-for="item in theaters">
          <img class="theater__image" v-bind:src="item.image" />
          <span class="theater__name">{{ item.name }}</span>
          <span class="theater__city">{{ item.city }}</span>
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
    theaters: types.GET_THEATER_LIST,
  }),
  created() {
    this.$store.dispatch(types.LOAD_THEATER_LIST);
  },
};

</script>

