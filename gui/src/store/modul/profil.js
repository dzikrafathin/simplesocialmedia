import Client from '../../repo/client/AxiosClient'
import RepoFactory from '../../repo/RepoFactory'

const profil = RepoFactory.get('profil')

export default {
    state : () => ({
        token : '' || localStorage.getItem('token'),
        user : {}
    }),
    mutations: {
        set_token(state, token) {
            state.token = token
        },
        set_user(state, user) {
            state.user = user
        }
    },
    actions: {
        lihat({commit}) {
            return new Promise((resolve, reject) => {
                profil.lihat()
                .then(res => {
                    commit('set_user', res.data)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        daftar({dispatch, commit}, payload) {
            return new Promise((resolve, reject) => {
                profil.daftar(payload)
                .then(res => {
                    const token = res.data.data.token
                    localStorage.setItem('token', token)
                    commit('set_token', token)
                    Client.defaults.headers.common['Authorization'] = `Bearer ${token}`
                    dispatch('lihat')
                    .then(() => {
                        resolve(res)
                    }).catch(err => {
                        reject(err)
                    })
                }).catch(err => {
                    reject(err)
                })
            })
        },
        login({dispatch, commit}, payload) {
            return new Promise((resolve, reject) => {
                profil.login(payload)
                .then(res => {
                    const token = res.data.data.token
                    localStorage.setItem('token', token)
                    commit('set_token', token)
                    Client.defaults.headers.common['Authorization'] = `Bearer ${token}`
                    dispatch('lihat')
                    .then(() => {
                        resolve(res)
                    }).catch(err => {
                        reject(err)
                    })
                }).catch(err => {
                    reject(err)
                })
            })
        },
        logout({commit}) {
            return new Promise((resolve, reject) => {
                profil.logout()
                .then(() => {
                    localStorage.removeItem('token')
                    commit('set_token','')
                    resolve()
                }).catch(err => {
                    reject(err)
                })
            })
        },
        perbarui({commit}, payload) {
            return new Promise((resolve, reject) => {
                profil.perbarui(payload)
                .then(res => {
                    const user = res.data.data.user
                    commit('set_user', user)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        }
    },
    getters : {
        sudahMasuk : state => !!state.token
    }
}