import Client from './Clients/AxiosClient';

const res = '/postingan'

export default {
    index() {
        return Client.get(`${res}`)
    },
    indexUser(id) {
        return Client.get(`/user/${id}${res}`)
    },
    buat(payload) {
        return Client.post(`${res}`, payload,
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
    },
    perbarui(payload, id) {
        return Client.put(`${res}/${id}`, payload)
    },
    hapus(id) {
        return Client.delete(`${res}/${id}`)
    }
};