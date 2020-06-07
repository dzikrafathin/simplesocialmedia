<template>
    <v-card class="mb-3">
        <user-postingan
            :user="postingan.user"
            :waktu="postingan.created_at"
        ></user-postingan>
        <v-card-text
            class="text--primary"
        >
            {{postingan.isi}}
        </v-card-text>
        <slide-foto
            :postingan-id="postingan.id"
        />
        <postingan-aksi
            :data="postingan.data"
            :postinganId="postingan.id"
            :bisaDiEdit="bisaDiEdit"
            :isi="postingan.isi"
        />
    </v-card>
</template>

<script>
import {mapState} from 'vuex'
import UserPostingan from '../user/UserPostingan.vue'
import PostinganAksi from './PostinganAksi.vue'
import SlideFoto from './SlideFoto.vue'

export default {
    props : ['postingan'],
    components : {
        UserPostingan,
        PostinganAksi,
        SlideFoto
    },
    computed : {
        ...mapState({
            userId : state => state.auth.user.id
        }),
        bisaDiEdit() {
            return this.userId == this.postingan.user_id
        }
    }
}
</script>