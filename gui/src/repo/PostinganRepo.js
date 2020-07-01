import Client from './client/AxiosClient'

export default {
    index(user = null) {
        if (user) {
            return Client.get(`user/${user}/postingan`)
        } else {
            return Client.get('postingan')
        }
    },
    buat(payload) {
        return Client.post(
            'postingan', 
            payload,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        )
    },
    ubah(id, payload) {
        return Client.put(
            `postingan/${id}`,
            payload
        )
    },
    hapus(id) {
        return Client.delete(`postingan/${id}`)
    }
}