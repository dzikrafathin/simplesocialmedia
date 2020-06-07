<template>
    <v-container fluid>
        <v-row
            justify="center"
        >
            <v-col md="6">
                <tambah-postingan/>
                <template v-if="loading">
                    <v-skeleton-loader
                        class="mx-auto"
                        type="card"
                    ></v-skeleton-loader>
                </template>
                <template v-else>
                    <template v-if="adaPostingan">
                        <Postingan
                            v-for="postingan in daftarPostingan"
                            :key="postingan.id"
                            :postingan="postingan"
                        />
                    </template>
                    <template v-else>
                        <v-alert 
                            outlined
                            type="info"
                            >
                            Belum ada postingan terbaru
                        </v-alert>
                    </template>
                </template>
            </v-col>
            <v-col md="3">
                <v-card>
                    <User />
                    <v-divider/>
                    <UserList />
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import Postingan from '../components/postingan/Postingan.vue'
import TambahPostingan from '../components/postingan/TambahPostingan.vue'
import User from '../components/user/User.vue'
import UserList from '../components/user/UserList.vue'

export default {
    components : {
        Postingan,
        TambahPostingan,
        User,
        UserList
    },
    created() {
        this.mulai()
    },
    data : () => ({
        loading : false
    }),
    methods : {
        ...mapActions({
            indexPostingan : 'indexPostingan'
        }),
        mulai() {
            this.indexPostingan()
            .then(() => {
                this.loading = false
            }).catch(err => {
                console.log(err)
            })
            this.loading = true
        }
    },
    computed : {
        ...mapState({
            daftarPostingan : state => state.postingan.daftarPostingan
        }),
        adaPostingan() {
            return this.daftarPostingan.length > 0 || this.loading
        }
    }
}
</script>