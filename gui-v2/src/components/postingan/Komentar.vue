<template>
    <v-card
        outlined
        class="ma-2"
    >
        <user-postingan 
            :user="komentar.user"
            :waktu="komentar.created_at"
        />
        <v-card-text
            class="text--primary"
        >
            {{komentar.isi}}
        </v-card-text>
        <v-card-actions v-if="bisaDiEdit">
            <v-spacer/>
            <hapus-komentar 
                :id="komentar.id"
            />
            <edit-komentar
                :komentar="komentar"
            />
        </v-card-actions>
    </v-card>
</template>

<script>
import {mapState} from 'vuex'
import UserPostingan from '../user/UserPostingan.vue'
import EditKomentar from '../komentar/EditKomentar.vue'
import HapusKomentar from '../komentar/HapusKomentar.vue'

export default {
    props : ['komentar'],
    components : {
        UserPostingan,
        EditKomentar,
        HapusKomentar
    },
    computed : {
        ...mapState({
            userId : state => state.auth.user.id
        }),
        bisaDiEdit() {
            return this.userId == this.komentar.user_id
        }
    }
}
</script>