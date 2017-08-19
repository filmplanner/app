import * as types from '../types';
import HTTP from '../http-common';

// initial state
const state = {
  all: [],
};

// actions
const actions = {
  [types.LOAD_THEATER_LIST]: ({ commit }) => {
    if (state.all.length === 0) {
      HTTP.get('/theaters')
      .then((response) => {
        commit(types.SET_THEATER_LIST, { list: response.data });
      });
    }
  },
};

// mutations
const mutations = {
  [types.SET_THEATER_LIST]: (state, { list }) => {
    state.all = list;
  },
};

// getters
const getters = {
  [types.GET_THEATER_LIST]: (state) => {
    return state.all;
  },
};

export default { state, actions, mutations, getters };
