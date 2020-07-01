<template>
    <v-card
        transition="slide-y-transition"
    >
        <h1>TEST SATU</h1>
    </v-card>
</template>

<script>
export default {
    created() {
        this.$parent.pesanError('testing error')
    }
}
</script>