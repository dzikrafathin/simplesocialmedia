<template>
    <v-list-item>
        <template v-if="udahSiap">
            <v-list-item-avatar>
                <v-img 
                    v-if="punyaFoto"
                    :src="$baseURL + user.foto"
                ></v-img>
                <v-icon
                    class="grey lighten-1 white--text"
                    v-else
                >mdi-account</v-icon>
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title>{{user.nama}}</v-list-item-title>
                <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
            </v-list-item-content>
        </template>
    </v-list-item>
</template>

<script>
import {mapState} from 'vuex'

export default {
    computed : {
        ...mapState({
            user : state => state.auth.user
        }),
        punyaFoto() {
            return this.user.foto != null
        },
        udahSiap() {
            return this.user != null
        }
    },
    created() {
        console.log(this.udahSiap)
    }
}
</script>