<template>
    <v-list-item>
        <v-list-item-avatar>
            <v-icon v-if="user.foto == null" class="grey lighten-1 white--text">mdi-account</v-icon>
            <v-img 
                v-else 
                :src="$baseURL + user.foto"
                ></v-img>
        </v-list-item-avatar>
        <v-list-item-content>
            <v-list-item-title>{{user.nama}}</v-list-item-title>
            <v-list-item-subtitle>{{waktu}}</v-list-item-subtitle>
        </v-list-item-content>
    </v-list-item>
</template>

<script>
export default {
    props : ['user','waktu']
}
</script>