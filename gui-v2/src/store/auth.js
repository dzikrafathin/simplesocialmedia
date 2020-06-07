import Client from '../repositories/Clients/AxiosClient.js'
import RepoFactory from '../repositories/RepoFactory'

const userRepo = RepoFactory.get('user')

export default {
    state : () => ({
      status : '',
      token : localStorage.getItem('token') || '',
      user : null
    }),
    mutations: {
      auth_request(state) {
        state.status = 'loading'
      },
      auth_success(state, token) {
        state.status = 'success',
        state.token = token
      },
      auth_error(state) {
        state.status = 'error'
      },
      logout(state) {
        state.status = ''
        state.token = ''
      },
      isi_user(state, user) {
        state.user = user
      }
    },
    actions : {
      login({commit},user) {
        return new Promise((resolve, reject) => {
          commit('auth_request')
          userRepo.login(user)
          .then(res => {
            
            const user = res.data.user
            const token = res.data.token

            localStorage.setItem('token',token)
            Client.defaults.headers.common['Authorization'] = `Bearer ${token}`
  
            commit('auth_success',token)
            commit('isi_user',user)

            resolve(res)
  
          }).catch(err => {
            commit('auth_error')
            localStorage.removeItem('token')
            reject(err)
          })
        });
      },
      register({commit}, user) {
        return new Promise((resolve, reject) => {
          commit('auth_request')
          userRepo.register(user)
          .then(res => {
            const user = res.data.user
            const token = res.data

            localStorage.setItem('token',token)
            Client.defaults.headers.common['Authorization'] = `Bearer ${token}`
  
            commit('auth_success',token)
            commit('isi_user',user)
            resolve(res)
  
          }).catch(err => {
            commit('auth_error')
            localStorage.removeItem('token')
            reject(err)
          })
        })
      },
      updateProfile({commit},payload) {
        return new Promise((resolve, reject) => {
          userRepo.update(payload)
          .then(res => {
            commit('isi_user',res.data)
            resolve(res)
          }).catch(err => {
            reject(err)
          })
        })
      },
      isiUser({commit}) {
        userRepo.lihatProfil()
        .then(res => {
          commit('isi_user',res.data) 
        })
      }
    },
    getters : {
      isLoggedIn : state => !!state.token,
      authStatus : state => state.status,
    }
  }