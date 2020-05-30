<template>
    <v-container fluid>
        <v-row>
            <v-col
                md="8"
            >
                <Postingan
                    v-for="postingan in daftarPostingan" 
                    :key="postingan.id"
                    :id="postingan.id"
                    :user="postingan.user"
                    :isi="postingan.isi"
                    :createdAt="postingan.created_at"
                    :updatedAt="postingan.updated_at"
                />
            </v-col>
            <v-col
                md="4"
            >
                <UserProfile
                    :id="$route.params.id"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import UserProfile from '../components/UserProfile.vue'
import Postingan from '../components/postingan/Postingan.vue'

export default {
    components : {
        UserProfile,
        Postingan
    },
    created() {
        this.$http.get('/user/'+this.$route.params.id+'/postingan')
        .then(res => {
            this.daftarPostingan = res.data
        })
    },
    data : () => ({
        daftarPostingan : []
    })
}
</script>