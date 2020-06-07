import Client from './Clients/AxiosClient';

const parent = '/postingan'
const res = '/like'

export default {
    index(id) {
        return Client.get(`${parent}/${id}${res}`)
    },
    buat(id) {
        return Client.post(`${parent}/${id}${res}`)
    },
    hapus(id) {
        return Client.delete(`${res}/${id}`)
    }
};