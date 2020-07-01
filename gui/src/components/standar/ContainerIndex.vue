<template>
    <div>
        <slot
            v-if="berhasil"
        ></slot>
        <v-alert
            v-else
            class="ma-2"
            :type="tipe"
        >
            {{isi}}
        </v-alert>
    </div>
</template>

<script>
export default {
    props : ['berhasil','isi','tipe'],
}
</script>