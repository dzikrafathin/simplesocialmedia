import Client from './client/AxiosClient'

/**
 * Route::get('user/profil','V2\ProfileController@profil');
Route::post('user/login','V2\ProfileController@login');
Route::post('user/logout','V2\ProfileController@logout');
Route::post('user/daftar','V2\ProfileController@daftar');
Route::post('user/profil','V2\ProfileController@update');

 */

export default {
    lihat() {
        return Client.get('/user/profil')
    },
    daftar(payload) {
        return Client.post('user/daftar', payload)
    },
    login(payload) {
        return Client.post('user/login', payload)
    },
    perbarui(payload) {
        return Client.post(
            'user/profil',
            payload,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        )
    },
    logout() {
        return Client.post('user/logout')
    }
}