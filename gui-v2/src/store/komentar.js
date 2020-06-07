import RepoFactory from '../repositories/RepoFactory'

const komentar = RepoFactory.get('komentar')

export default {
    state : () => ({
        daftarKomentar : []
    }),
    mutations : {
        tambah_komentar(state, payload) {
            const duplikat = state.daftarKomentar.find(komentar => komentar.id === payload.id);
            if (duplikat == undefined) {
                state.daftarKomentar.push(payload)
            }
        },
        perbarui_komentar(state, payload) {
            const item = state.daftarKomentar.find(komentar => komentar.id === payload.id)
            Object.assign(item,payload)
        },
        hapus_komentar(state, id) {
            const i = state.daftarKomentar.map(komentar => komentar.id).indexOf(id)
            state.daftarKomentar.splice(i,1);
        }
    },
    actions : {
        indexKomentar({commit}, postinganId) {
            return new Promise((resolve, reject) => {
                komentar.index(postinganId)
                .then(res => {
                    const data = res.data
                    data.forEach(komentar => {
                        commit('tambah_komentar',komentar)
                    })
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        tambahKomentar({commit}, payload) {
            return new Promise((resolve, reject) => {
                komentar.buat(payload.postinganId, payload.komentar)
                .then(res => {
                    commit('tambah_komentar',res.data)
                    resolve(res)
                }).catch(err => {
                    reject(err.response.data)
                })
            })
        },
        perbaruiKomentar({commit}, payload) {
            return new Promise((resolve, reject) => {
                komentar.perbarui(payload,payload.id)
                .then(res => {
                    commit('perbarui_komentar',res.data)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        hapusKomentar({commit}, id) {
            return new Promise((resolve, reject) => {
                komentar.hapus(id)
                .then(() => {
                    commit('hapus_komentar',id)
                    resolve(true)
                }).catch(err => {
                    reject(err)
                })
            })
        }
    },
    getters : {
        getKomentar : (state) => (postinganId) => {
            return state.daftarKomentar.filter(komentar => komentar.postingan_id === postinganId)
        }
    }
}
