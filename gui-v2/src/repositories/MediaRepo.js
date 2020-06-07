import Client from './Clients/AxiosClient';

const parent = '/postingan'
const res = '/media'

export default {
    index(id) {
        return Client.get(`${parent}/${id}${res}`)
    },
    buat(id, payload) {
        return Client.post(`${parent}/${id}${res}`, 
        payload,
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
    },
    hapus(id) {
        return Client.delete(`${res}/${id}`)
    }
};