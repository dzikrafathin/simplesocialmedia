import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import postingan from './postingan'
import media from './media'
import like from './like'
import komentar from './komentar'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    like : like,
    auth : auth,
    postingan : postingan,
    media: media,
    komentar : komentar
  }
})
