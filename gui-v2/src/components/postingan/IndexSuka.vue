<template>
    <v-dialog
        max-width="500"
        v-model="tampil"
    >
        <template v-slot:activator="{ on }">
            <v-btn
                small
                color="primary"
                outlined
                v-on="on"
            >
                {{jumlah}} Suka
            </v-btn>
        </template>
        <v-card>
            <v-card-title>Daftar Suka</v-card-title>
            <v-card-text>
                <!---->
                <template v-if="loading">
                    <v-skeleton-loader
                        class="mx-auto"
                        type="list-item-avatar-two-line"
                    ></v-skeleton-loader>
                </template>
                <template v-else>
                    <template v-if="adaSuka">
                        <user-postingan
                            v-for="like in getLike(postinganId)"
                            :key="like.id"
                            :user="like.user"
                            :waktu="like.created_at"
                        />
                    </template>
                    <template v-else>
                        <v-alert 
                            outlined
                            type="info"
                        >
                            Belum ada yang menyukai postingan ini
                        </v-alert>
                    </template>
                </template>
                <!--</template>
                <template v-else>
                    <v-alert 
                        outlined
                        type="info"
                        >
                        Belum ada yang menyukai postingan ini
                    </v-alert>
                </template>-->
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import UserPostingan from '../user/UserPostingan.vue'

export default {
    props : ['jumlah','postinganId'],
    data : () => ({
        tampil : false,
        loading : false
    }),
    components : {
        UserPostingan 
    },
    computed : {
        ...mapGetters({
            getLike : 'getLike'
        }),
        adaSuka() {
            return this.getLike(this.postinganId).length > 0
        }
    },
    methods : {
        ...mapActions({
            indexLike : 'indexLike'
        }),
        mulai() {
            this.indexLike(this.postinganId)
            .then(() => {
                this.loading = false
            }).catch(err => {
                console.log(err)
            })
            this.loading = true
        }
    },
    watch : {
        tampil : function() {
            if (this.tampil) {
                this.mulai()
            }
        }
    }
}
</script>