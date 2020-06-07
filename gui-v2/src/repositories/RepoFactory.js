import PostinganRepo from './PostinganRepo'
import MediaRepo from './MediaRepo'
import LikeRepo from './LikeRepo'
import KomentarRepo from './KomentarRepo'
import UserRepo from './UserRepo'

const repo = {
    'postingan' : PostinganRepo,
    'media' : MediaRepo,
    'like' : LikeRepo,
    'komentar' : KomentarRepo,
    'user' : UserRepo
}

export default {
    get : name => repo[name]
}