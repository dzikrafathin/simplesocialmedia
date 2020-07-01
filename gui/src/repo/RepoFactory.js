import ProfilRepo from './ProfilRepo'
import PostinganRepo from './PostinganRepo'
import LikeRepo from './LikeRepo'

const repo = {
    'profil' : ProfilRepo,
    'postingan' : PostinganRepo,
    'like' : LikeRepo
}

export default {
    get : name => repo[name]
}