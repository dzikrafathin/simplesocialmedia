<template>
    <v-container fluid>
        <v-snackbar
            v-model="pesan.tampil"
            :color="pesan.tipe"
        >
            {{pesan.isi}}
        </v-snackbar>
        <v-row
            justify="center"
        >
            <v-col md="6">
                <v-card>
                    <v-card-title>Ubah Profil</v-card-title>
                    <v-card-text>
                        <v-form id="profile">
                            <v-text-field
                                label="Nama"
                                name="nama"
                                prepend-icon="mdi-account"
                                v-model="user.nama"
                            />
                            <v-text-field
                                label="E-Mail"
                                name="email"
                                prepend-icon="mdi-email"
                                v-model="user.email"
                            />
                            <v-menu
                                v-model="menu2"
                                :close-on-content-click="false"
                                :nudge-right="40"
                                transition="scale-transition"
                                offset-y
                                min-width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        name="tanggal_lahir"
                                        v-model="user.tanggal_lahir"
                                        label="Tanggal Lahir"
                                        prepend-icon="mdi-calendar-range"
                                        readonly
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker v-model="user.tanggal_lahir" @input="menu2 = false"></v-date-picker>
                            </v-menu>
                            <v-text-field
                                name="tempat_lahir"
                                prepend-icon="mdi-map-marker"
                                label="Tempat Lahir"
                                v-model="user.tempat_lahir"
                            ></v-text-field>
                            <v-textarea
                                name="alamat"
                                prepend-icon="mdi-map-marker"
                                label="Alamat"
                                v-model="user.alamat"
                            ></v-textarea>
                            <v-text-field
                                name="no_hp"
                                prepend-icon="mdi-phone"
                                label="No Hp"
                                v-model="user.no_hp"
                            />
                            <v-file-input 
                                name="foto"
                                accept="image/*" 
                                label="Upload Foto Profil"
                                prepend-icon="mdi-camera"
                                chips
                                ></v-file-input>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer/>
                        <v-btn
                            color="success"
                            outlined
                            @click="update"
                        >
                            Ubah
                        </v-btn>
                    </v-card-actions>
                </v-card>
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
import {mapState, mapActions} from 'vuex'

export default {
    data : () => ({
       menu2 : false,
       pesan : {
           tampil : false,
           isi : '',
           tipe : ''
       }
    }),
    created() {
        
    },
    computed : {
        ...mapState({
            user : state => state.auth.user
        }),
        punyaFoto() {
            return this.user.foto != null
        }
    },
    methods : {
        ...mapActions({
            updateProfile : 'updateProfile'
        }),
        update() {
            const data = new FormData(document.getElementById('profile'));
            this.updateProfile(data)
            .then(() => {
                this.pesanSukses('Berhasil disimpan')
            }).catch(err => {
                console.log(err)
                this.pesanError('Terjadi Kesalahan')
            })
        },
        pesanSukses(pesan) {
            this.pesan = {
                tampil : true,
                isi : pesan,
                tipe : 'success'
            }
        },
        pesanError(pesan) {
            this.pesan = {
                tampil : true,
                isi : pesan,
                tipe : 'error'
            }
        }
    }
}
</script>