<template>
    <v-card class="my-2">
        <User 
            :user="user" 
            :waktu="createdAt"
        />
        <v-card-text 
            class="text--primary py-1"
        >
            {{isi}}
        </v-card-text>
        <Media
            :postinganId="id"
            :postinganUserId="user.id"    
        />
        <Like
            :postinganId="id"
        />
        <Komentar
            :postinganId="id"
            :postinganUserId="user.id"
        />
    </v-card>
</template>

<script>
import User from '../User.vue'
import Like from '../postingan/like/LikeMain.vue'
import Komentar from '../postingan/komentar/KomentarMain.vue'
import Media from '../postingan/media/MediaMain.vue'

export default {
    props : ['id','user','isi','createdAt','updatedAt'],
    components: {
        User,
        Like,
        Komentar,
        Media
    }
}
</script>