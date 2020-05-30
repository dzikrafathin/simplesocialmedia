import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    status : '',
    token: localStorage.getItem('token') || '',
    user:{}
  },
  mutations: {
    auth_success(state,token) {
      state.status = 'success'
      state.token = token
    },
    info_user(state,user) {
      state.user = user
    },
    auth_error(state) {
      state.status = 'error'
    },
    auth_logout(state) {
      state.user = {}
      state.token = ''
      state.status = ''
    }
  },
  actions: {
    login({commit}, user) {
      return new Promise((resolve, reject) => {
        axios({
          url: 'login',
          data: user,
          method: 'POST'
        }).then(resp => {
          const token = resp.data

          localStorage.setItem('token',token)
          axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

          commit('auth_success', token)
          this.dispatch('user_info')

          resolve(resp)
        }).catch(err => {
          localStorage.removeItem('token')
          commit('auth_error')
          reject(err)
        })
      })
    },
    register({commit},user) {
      return new Promise((resolve, reject) => {
        axios({
          url: 'user',
          data: user,
          method: 'POST'
        }).then(res => {
          const token = res.data

          localStorage.setItem('token',token)
          axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

          commit('auth_success', token)
          this.dispatch('user_info')
          resolve(res)

        }).catch(err => {
          localStorage.removeItem('token')
          commit('auth_error')
          reject(err)
        })
      })
    },
    logout({commit}) {
      commit('auth_logout')
      localStorage.removeItem('token')
      delete axios.defaults.headers.common['Authorization']
    },
    user_info({commit}) {
      axios.get('login')
      .then(res => {
        commit('info_user',res.data)
      })
    }
  },
  getters: {
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status
  }
})
