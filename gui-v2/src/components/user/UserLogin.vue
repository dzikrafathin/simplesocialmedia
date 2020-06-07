<template>
            <div>
                <v-avatar v-if="isLoggedIn" color="teal" size="48">
                    <!--
                    <v-icon
                        class="grey lighten-1 white--text"
                    >mdi-account</v-icon>
                    -->
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
            </div>
            <!--
            <template v-else-if="$route.name != 'Halaman Login'">
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
        <v-list two-line v-if="isLoggedIn">
            <v-list-item class="ma-0">
                <v-list-item-avatar>
                    <v-img 
                        v-if="user.foto != null"
                        :src="$baseURL + user.foto"
                        ></v-img>
                    <v-icon
                        class="grey lighten-1 white--text"
                        v-else>mdi-account</v-icon>
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title>{{user.nama}}</v-list-item-title>
                    <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-menu>-->
</template>

<script>
import {mapState, mapGetters, mapActions} from 'vuex'

export default {
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