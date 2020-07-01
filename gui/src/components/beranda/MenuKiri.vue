<template>
    <v-card>
        <v-list>
            <User 
                :nama="user.nama"
                :subjudul="user.email"
                :foto="user.foto"
            />
            <v-divider/>
            <v-list
                nav
            >
                <v-list-item
                    link
                    to="/"
                    dense
                >
                    <v-list-item-title>
                        Beranda
                    </v-list-item-title>
                </v-list-item>
                <v-list-item
                    link
                    dense
                    to="/profil"
                >
                    <v-list-item-title>
                        Profil
                    </v-list-item-title>
                </v-list-item>
                <v-list-item
                    link
                    dense
                >
                    <v-list-item-title>
                        Keluar
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-list>
    </v-card>
</template>

<script>
import {mapState} from 'vuex'
import User from '../standar/User'

export default {
    components : {
        User
    },
    computed : {
        ...mapState({
            user : state => state.profil.user
        })
    }
}
</script>