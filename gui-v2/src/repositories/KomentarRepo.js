import Client from './Clients/AxiosClient';

const parent = '/postingan'
const res = '/komentar'

export default {
    index(id) {
        return Client.get(`${parent}/${id}${res}`)
    },
    buat(id, payload) {
        return Client.post(`${parent}/${id}${res}`,payload)
    },
    perbarui(payload, id) {
        return Client.put(`${res}/${id}`, payload)
    },
    hapus(id) {
        return Client.delete(`${res}/${id}`)
    }
};