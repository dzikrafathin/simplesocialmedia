import RepoFactory from '../../repo/RepoFactory'

const postingan = RepoFactory.get('postingan')

export default {
    state : () => ({
        daftarPostingan : [],
        daftarLike : [],
        daftarKomentar : []
    }),
    mutations : {
        tambah_postingan(state, payload) {
            const duplikat = state.daftarPostingan.find(postingan => postingan.id === payload.id)
            if (duplikat == undefined) {
                state.daftarPostingan.unshift(payload)
            }
        },
        ubah_postingan(state, payload) {
            const item = state.daftarPostingan.find(item => item.id === payload.id)
            Object.assign(item, payload)
        },
        hapus_postingan(state, id) {
            const i = state.daftarPostingan.map(item => item.id).indexOf(id)
            state.daftarPostingan.splice(i,1)
        }
    },
    actions : {
        indexPostingan({commit}) {
            return new Promise((resolve, reject) => {
                postingan.index()
                .then(res => {
                    const data = res.data
                    data.forEach(postingan => {
                        commit('tambah_postingan',postingan)
                    })
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        tambahPostingan({commit}, payload) {
            return new Promise((resolve, reject) => {
                postingan.buat(payload)
                .then(res => {
                    const data = res.data.data
                    commit('tambah_postingan',data)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        hapusPostingan({commit}, id) {
            return new Promise((resolve, reject) => {
                postingan.hapus(id)
                .then(res => {
                    commit('hapus_postingan', id)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        }
    }
}