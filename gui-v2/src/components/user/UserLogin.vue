<template>
    <div>
        <template v-if="loading">
            <v-skeleton-loader
                type="avatar"
            ></v-skeleton-loader>
        </template>
        <template v-else>
                <v-avatar v-if="isLoggedIn" color="teal" size="48">
                    <v-img 
                        v-if="user.foto != null"
                        :src="$baseURL + user.foto"
                        ></v-img>
                    <v-icon
                        class="grey lighten-1 white--text"
                        v-else>mdi-account</v-icon>
                </v-avatar>
                <template v-else>
                    <v-btn
                        small
                        color="primary"
                    >Daftar</v-btn>
                    <v-btn
                        class="mr-1"
                        small
                        color="success"
                    >Login</v-btn>
                </template>
        </template>
    </div>
</template>

<script>
import {mapState, mapGetters, mapActions} from 'vuex'

export default {
    data : () => ({
        loading : false
    }),
    created() {
        if (this.isLoggedIn) {
            this.loading = true
            this.isiUser()
            .then(() => {
                this.loading = false
            })
        }
    },
    computed : {
        ...mapState({
            user : state => state.auth.user
        }),
        ...mapGetters({
            isLoggedIn : 'isLoggedIn'
        })
    },
    methods : {
        ...mapActions({
            isiUser: 'isiUser'
        })
    }
}
</script>