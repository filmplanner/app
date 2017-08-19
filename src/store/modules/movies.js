import * as types from '../types';
import HTTP from '../http-common';

// initial state
const state = {
  all: [],
  limit: 50,
  skip: 0,
};

// actions
const actions = {
  [types.LOAD_MOVIE_LIST]: ({ commit }) => {
    HTTP.get(`movies?limit=${state.limit}&skip=${state.skip}`)
    .then((response) => {
      commit(types.SET_MOVIE_LIST, { list: response.data });
    });
  },
};

// mutations
const mutations = {
  [types.SET_MOVIE_LIST]: (state, { list }) => {
    state.all = list;
  },
};

// getters
const getters = {
  [types.GET_MOVIE_LIST]: (state) => {
    return state.all;
  },
};

export default { state, actions, mutations, getters };
