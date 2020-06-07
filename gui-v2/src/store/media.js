import RepoFactory from '../repositories/RepoFactory';

const media = RepoFactory.get('media');

export default {
    state : () => ({
        daftarMedia : []
    }),
    mutations : {
        index_media(state, payload) {
            state.daftarMedia = state.daftarMedia.concat(payload)
        },
        tambah_media(state, payload) {
            payload.forEach(media => {
                state.daftarMedia.push(media)
            })
        },
        hapus_media(state, id) {
            const i = state.daftarMedia.map(item => item.id).indexOf(id);
            state.daftarMedia.splice(i,1);
        }
    },
    actions : {
        indexMedia({commit},id) {
            return new Promise((resolve, reject) => {
                media.index(id)
                .then(res => {
                    if (res.data.length > 0) {
                        commit('index_media',res.data)
                        resolve(res)
                    } else {
                        reject(false)
                    }
                }).catch(err => {
                    reject(err)
                })
            });
        },
        tambahMedia({commit},payload) {
            return new Promise((resolve, reject) => {
                media.buat(payload.id,payload.data)
                .then(res => {
                    commit('tambah_media',res.data)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        hapusMedia({commit},id) {
            return new Promise((resolve, reject) => {
                media.hapus(id)
                .then(res => {
                    commit('hapus_media',id)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        }
    },
    getters : {
        getMedia : (state) => (postinganId) => {
            return state.daftarMedia.filter(media => media.postingan_id === postinganId)
        } 
    }
}
