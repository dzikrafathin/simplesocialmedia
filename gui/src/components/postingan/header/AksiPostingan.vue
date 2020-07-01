<template>
    <v-row
        no-gutters
        justify="end"
    >
        <v-btn
            x-small
            text
            color="success"
        >edit</v-btn>
        <v-btn
            x-small
            text
            class="mr-2"
            color="error"
            @click="toggleOverlay"
        >hapus</v-btn>
    </v-row>
</template>

<script>
export default {
    inject : ['toggleOverlay']
}
</script>