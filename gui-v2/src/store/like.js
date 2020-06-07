import RepoFactory from '../repositories/RepoFactory'

const like = RepoFactory.get('like')

export default {
    state : () => ({
        daftarLike : []
    }),
    mutations : {
        tambah_like(state, payload) {
            const duplikat = state.daftarLike.find(like => like.id === payload.id);
            if (duplikat == undefined) {
                state.daftarLike.push(payload)
            }
        },
        hapus_like(state, id) {
            const i = state.daftarLike.map(item => item.id).indexOf(id);
            if (i) {
                state.daftarLike.splice(i,1);
            }
        }
    },
    actions : {
        indexLike({commit}, postinganId) {
            return new Promise((resolve, reject) => {
                like.index(postinganId)
                .then(res => {
                    const data = res.data
                    data.forEach(like => {
                        commit('tambah_like',like)
                    })
                    resolve(res.data)
                }).catch(() => {
                    reject(false)
                })
            })
        },
        sukai({commit},postinganId) {
            return new Promise((resolve, reject) => {
                like.buat(postinganId)
                .then((res) => {
                    commit('tambah_like',res.data)
                    resolve(res.data)
                }).catch(() => {
                    reject(false)
                })
            })
        },
        tidakSukai({commit},likeId) {
            return new Promise((resolve, reject) => {
                like.hapus(likeId)
                .then(() => {
                    commit('hapus_like',likeId)
                    resolve(true)
                }).catch((err) => {
                    reject(err)
                })
            })
        }
    },
    getters : {
        getLike : (state) => (postinganId) => {
            return state.daftarLike.filter(like => like.postingan_id === postinganId)
        }
    }
}