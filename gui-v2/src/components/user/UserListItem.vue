<template>
    <v-list-item
        link
        :to="{ name: 'Profil User', params: { id: user.id }}"
    >
        <v-list-item-avatar>
            <v-img 
                v-if="punyaFoto"
                :src="$baseURL + user.foto"
                ></v-img>
            <v-icon
                v-else
                class="grey lighten-1 white--text"
            >mdi-account</v-icon>
        </v-list-item-avatar>
        <v-list-item-content>
            <v-list-item-title>{{user.nama}}</v-list-item-title>
        </v-list-item-content>
    </v-list-item>
</template>

<script>
export default {
    props : ['user'],
    computed : {
        punyaFoto() {
            return this.user.foto != null
        }
    }
}
</script>