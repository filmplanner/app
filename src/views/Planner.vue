<template>
  
  <div class="content-wrapper">

    <div class="filter">
      <div class="container-fluid"> 
        <div class="row">

          <div class="col-5">
            <input type="text" class="form-control filter__search" placeholder="Zoeken naar een film..">
          </div>

           <div class="col">
            Dag
          </div>

          <div class="col">
            <div id="slider" class="filter__time"></div>
          </div>

          <div class="col">
            <b-btn @click="$root.$emit('show::modal','modal1')"><i class="fa fa-fw fa-map-marker"></i></b-btn>
          </div>

        </div>
      </div>
    </div>

    <div class="shows">
      Test
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import jQuery from 'jquery';
import 'nouislider/distribute/nouislider.min.css';
import * as types from '../store/types';

window.noUiSlider = require('nouislider');

export default {
  computed: mapGetters({
    movies: types.GET_MOVIE_LIST,
  }),
  created() {
    this.$store.dispatch(types.LOAD_MOVIE_LIST);

    jQuery(() => {
      const slider = document.getElementById('slider');

      window.noUiSlider.create(slider, {
        start: [20, 80],
        connect: true,
        range: {
          min: 0,
          max: 100,
        },
        tooltips: true,
      });
    });
  },
};
</script>

<style lang="scss">
@import '../assets/css/variables.scss';

.filter {
  background: $nav-bg-color;
  min-height: auto;
  padding: 15px 0px;

  .filter__search {
    border: 0px;
    border-radius: 0px;
    padding: 0.8em 1em;
  }

  .filter__day {
    border: 0px;
    border-radius: 0px;
    padding: 14px 26px 13px 15px;
    height: auto;
  }

  .filter__time {
    margin-top: 30px;
  }
}

</style>
