<template>
    <v-card>
        <v-card-title>Login User</v-card-title>
        <v-card-text>
            <v-text-field 
                label="Alamat E-Mail"
                outlined
                v-model="user.email"
                :error-messages="errors.email"
                @focus="hapusError"
                dense
                prepend-icon="mdi-email"
            />
            <v-text-field 
                label="Kata Sandi"
                outlined
                dense
                :error-messages="errors.password"
                v-model="user.password"
                @focus="hapusError"
                type="password"
                prepend-icon="mdi-lock"
            />
        </v-card-text>
        <v-card-actions>
            <v-spacer/>
            <v-btn
                color="primary"
            >
                Daftar
            </v-btn>
            <v-btn
                color="success"
                @click="kirimLogin"
            >
                Login
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    inject : [
        'pesanError', 
        'pesanSukses',
        'sembunyikanPesan'
    ],
    data : () => ({
        user : {
            email : '',
            password: ''
        },
        errors : {
            email : [],
            password : []
        }
    }),
    methods : {
        ...mapActions({
            login : 'login'
        }),
        hapusError() {
            this.sembunyikanPesan()
            this.errors = {
                email : [],
                password : []
            }
        },
        kirimLogin() {
            this.login(this.user)
            .then(() => {
                this.$router.push('/')
            }).catch(err => {
                this.errors = err.response.data.errors
                this.pesanError(err.response.data.message)
            })
        }
    }
}
</script>