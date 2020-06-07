<template>
    <v-dialog
        max-width="500"
        v-model="tampil"
    >
        <template v-slot:activator="{on}">
            <v-btn
                outlined
                small
                class="mx-1"
                color="error"
                v-on="on"
            >
                Hapus
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                Hapus Komentar
            </v-card-title>
            <v-card-text>
                Yakin ingin menghapus komentar ini?
            </v-card-text>
            <v-card-actions>
                <v-spacer/>
                <v-btn
                    small
                    color="primary"
                    outlined
                >
                    Batal
                </v-btn>
                <v-btn
                    small
                    color="error"
                    outlined
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
    props : ['id'],
    data : () => ({
        tampil : false
    }),
    methods : {
        ...mapActions({
            hapusKomentar : 'hapusKomentar'
        }),
        hapus() {
            this.hapusKomentar(this.id)
            .then(() => {
                this.tampil = false
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>