<template>
    <v-container fluid>
        <template v-if="tidakAda">
            <v-alert 
                outlined
                type="error"
                >
                Error 404 User tidak ditemukan!
            </v-alert>
        </template>
        <v-row
            justify="center"
            v-else
        >
            <v-col md="6">
                <template v-if="punyaPostingan">
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
                        User ini belum memposting apapun
                    </v-alert>
                </template>
            </v-col>
            <v-col md="3">
                <v-card>
                    <v-card-title>Profil</v-card-title>
                    <v-img 
                        v-if="punyaFoto" 
                        :src="$baseURL + user.foto"
                        contain
                        height="180"
                        ></v-img>
                    <v-list>
                        <v-list-item two-line>
                            <v-list-item-avatar>
                                <v-icon>
                                    mdi-account
                                </v-icon>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-subtitle>Nama</v-list-item-subtitle>
                                <v-list-item-title>{{user.nama}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item two-line>
                            <v-list-item-avatar>
                                <v-icon>
                                    mdi-email
                                </v-icon>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-subtitle>Email</v-list-item-subtitle>
                                <v-list-item-title>{{user.email}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item two-line>
                            <v-list-item-avatar>
                                <v-icon>
                                    mdi-phone
                                </v-icon>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-subtitle>No. Hp</v-list-item-subtitle>
                                <v-list-item-title>{{user.no_hp}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import RepoFactory from '../repositories/RepoFactory'
import {mapActions, mapGetters} from 'vuex'
import Postingan from '../components/postingan/Postingan.vue'

const user = RepoFactory.get('user')

export default {
    data : () => ({
        user : {},
        kosong : false,
        tidakAda : false
    }),
    components : {
        Postingan
    },
    computed : {
        ...mapGetters({
            getPostingan :'getUserPostingan'
        }),
        punyaFoto() {
            return this.user.foto != null
        },
        punyaPostingan() {
            return !this.kosong
        },
        daftarPostingan() {
            const userId = this.$route.params.id;
            return this.getPostingan(userId)
        }
    },
    methods : {
        ...mapActions({
            index : 'indexPostinganUser'
        })
    },
    created() {
        const id = this.$route.params.id

        user.lihat(id)
        .then(res => {
            this.user = res.data
        }).catch(err => {
            if (err.response.status == 404) {
                this.tidakAda = true
            }
        })
        this.index(id)
        .catch(err => {
            if (err.type == 'kosong') {
                this.kosong = true
            }
        })
    }
}
</script>