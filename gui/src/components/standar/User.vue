<template>
    <v-list-item
        link
    >
        <v-list-item-avatar>
            <v-img
                v-if="punyaFoto"
                :src="foto"
            ></v-img>
            <v-icon
                v-else
                class="grey lighten-1 white--text"
            >
                mdi-account
            </v-icon>
        </v-list-item-avatar>
        <v-list-item-content>
            <v-list-item-title>{{nama}}</v-list-item-title>
            <v-list-item-subtitle>{{subjudul}}</v-list-item-subtitle>
        </v-list-item-content>
    </v-list-item>
</template>

<script>
export default {
    props : ['nama','subjudul','foto'],
    computed : {
        punyaFoto() {
            return this.foto != null
        }
    }
}
</script>