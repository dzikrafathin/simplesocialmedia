<template>
    <div>
        <TambahPostingan
            :tambah="create"
        />
        <Postingan 
            v-for="postingan in daftarPostingan" 
            :key="postingan.id"
            :id="postingan.id"
            :user="postingan.user"
            :isi="postingan.isi"
            :createdAt="postingan.created_at"
            :updatedAt="postingan.updated_at"
            />
    </div>
</template>
<script>
import TambahPostingan from '../postingan/TambahPostingan.vue'
import Postingan from '../postingan/Postingan.vue'
import { mapState } from 'vuex'

export default {
    components : {
        TambahPostingan,
        Postingan
    },
    data: () => ({
       daftarPostingan : []
    }),
    created() {
        this.index();
    },
    methods : {
        index() {
            this.$http.get('postingan')
            .then(res => {
                this.daftarPostingan = res.data
            })
        },
        create(postingan) {
            this.$http.post('user/'+this.user.id+'/postingan',postingan,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
            .then(res => {
                this.daftarPostingan.unshift(res.data);
            })
        }
    },
    computed: mapState({
        user : state => state.user
    })
}
</script>