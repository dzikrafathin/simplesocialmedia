import Client from './client/AxiosClient'

export default {
    like(id) {
        return Client.post(`postingan/${id}/like`)
    },
    unlike(id) {
        return Client.delete(`postingan/${id}/like`)
    },
    daftarLike(id) {
        return Client.get(`postingan/${id}/like`)
    }
}