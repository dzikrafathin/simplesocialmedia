<template>
    <v-card
    >
        <v-tabs
            centered
            background-color="blue"
            dark
        >
            <v-tab
                to="/profil"
            >Biodata</v-tab>
            <v-tab
                to="/profil/foto"
            >Foto</v-tab>
            <v-tab>Suka</v-tab>
            <v-tab>Komentar</v-tab>
        </v-tabs>
        <router-view/>
    </v-card>
</template>

<script>
export default {
    inject : ['menuBukaTutup'],
    created() {
        this.menuBukaTutup(false)
    }
}
</script>