import Client from './Clients/AxiosClient';

const res = '/user'

export default {
    index() {
        return Client.get(`${res}`)
    },
    lihat(id) {
        return Client.get(`${res}/${id}`)
    },
    lihatProfil() {
        return Client.get('/user/profile')
    },
    login(payload) {
        return Client.post('/user/login',payload)
    },
    register(payload) {
        return Client.post('/user/register',payload)
    },
    update(payload) {
        return Client.post('/user/profile',payload,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
    },
    logout() {
        return Client.post('/user/logout')
    },
};