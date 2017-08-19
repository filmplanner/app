<template>
  <b-modal id="modal1" title="Bioscopen">
    <div v-for="items in theaters">
      Test
    </div>
  </b-modal>
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
