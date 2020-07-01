<template>
    <v-card-actions>
        <v-btn
            color="primary"
            small
        >
            <v-icon
                left
                small
                >
                mdi-thumb-up
            </v-icon>
            Disukai
        </v-btn>
        <v-spacer/>
        <v-btn
            text
            small
        >
            0 Suka
        </v-btn>
        <v-btn
            text
            small
            @click="toggleDaftarKomentar"
        >
            0 Komentar
        </v-btn>
    </v-card-actions>
</template>

<script>
export default {
    inject : ['toggleDaftarKomentar']
}
</script>