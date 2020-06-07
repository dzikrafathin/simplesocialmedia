<template>
    <v-dialog
        max-width="500"
        v-model="dialog"
    >
        <template v-slot:activator="{on}">
            <v-btn
                color="error"
                outlined
                v-on="on"
                class="mx-1"
            >
                Hapus Postingan
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                Hapus Postingan
            </v-card-title>
            <v-card-text>
                Apakah anda yakin ingin menghapus postingan ini ?
            </v-card-text>
            <v-card-actions>
                <v-spacer/>
                <v-btn
                    small
                    outlined
                    color="primary"
                    @click="dialog = false"
                >
                    Batal
                </v-btn>
                <v-btn
                    small
                    outlined
                    color="error"
                    @click="hapus"
                >
                    Hapus
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    props : ['postinganId'],
    data : () => ({
        dialog : false
    }),
    methods : {
        ...mapActions({
            hapusPostingan : 'hapusPostingan'
        }),
        hapus() {
            this.hapusPostingan(this.postinganId)
            .then(() => {
                this.dialog = false
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>