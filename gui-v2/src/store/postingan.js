import RepoFactory from '../repositories/RepoFactory';

const postingan = RepoFactory.get('postingan');

export default {
    state : () => ({
        daftarPostingan : []
    }),
    mutations : {
        index_postingan(state, payload) {
            state.daftarPostingan = payload
        },
        tambah_postingan(state, payload) {
            const duplikat = state.daftarPostingan.find(postingan => postingan.id === payload.id);
            if (duplikat == undefined) {
                state.daftarPostingan.unshift(payload);
            }
        },
        ubah_postingan(state, payload) {
            const item = state.daftarPostingan.find(item => item.id === payload.id);
            Object.assign(item,payload);
        },
        hapus_postingan(state, id) {
            const i = state.daftarPostingan.map(item => item.id).indexOf(id);
            state.daftarPostingan.splice(i,1);
        }
    },
    actions : {
        indexPostingan({commit}) {
            return new Promise((resolve, reject) => {
                postingan.index()
                .then(res => {
                    commit('index_postingan',res.data)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        indexPostinganUser({commit},id) {
            return new Promise((resolve, reject) => {
                postingan.indexUser(id)
                .then(res => {
                    const data = res.data
                    if (data.length > 0) {
                        data.forEach(postingan => {
                            commit('tambah_postingan',postingan)
                        })
                        resolve(res)
                    } else {
                        reject({
                            type : 'kosong'
                        })
                    }
                }).catch(err => {
                    reject(err)
                })
            })
        },
        tambahPostingan({commit},payload) {
            return new Promise((resolve, reject) => {
                postingan.buat(payload)
                .then(res => {
                    commit('tambah_postingan',res.data)
                    resolve(res)
                }).catch(err => {
                    reject(err.response.data)
                })
            })
        },
        ubahPostingan({commit},payload) {
            return new Promise((resolve, reject) => {
                postingan.perbarui(payload,payload.id)
                .then(res => {
                    commit('ubah_postingan',res.data)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        hapusPostingan({commit},id) {
            return new Promise((resolve, reject) => {
                postingan.hapus(id)
                .then(() => {
                    commit('hapus_postingan',id)
                    resolve(true)
                }).catch(err => {
                    reject(err)
                })
            })
        }
    },
    getters : {
        getUserPostingan : (state) => (userId) => {
            return state.daftarPostingan.filter(postingan => postingan.user_id == userId)
        }
    }
}