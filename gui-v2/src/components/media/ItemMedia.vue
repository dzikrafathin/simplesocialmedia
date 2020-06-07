<template>
    <v-col
        md="3"
    >
        <v-card
            outlined
        >
            <v-img
                contain
                height="180"
                :src="$baseURL + media.url"
            >
            </v-img>
            <v-card-actions>
                <v-spacer/>
                <v-dialog
                    v-model="dialogHapus"
                    max-width="500"
                >
                    <template v-slot:activator="{on}">
                        <v-btn
                            x-small
                            color="error"
                            v-on="on"
                        >
                            Hapus
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            Hapus Foto
                        </v-card-title>
                        <v-card-text>Anda yakin ingin menghapus foto {{media.nama}} ? </v-card-text>
                        <v-card-actions>
                            <v-spacer/>
                            <v-btn
                                x-small
                                color="primary"
                                outlined
                                @click="dialogHapus = false"
                            >
                                Batal
                            </v-btn>
                            <v-btn
                                x-small
                                color="error"
                                outlined
                                @click="hapus"
                            >
                                Hapus
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-card-actions>
        </v-card>
    </v-col>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    data : () => ({
        dialogHapus : false
    }),
    props : ['media'],
    methods : {
        ...mapActions({
            hapusMedia : 'hapusMedia'
        }),
        hapus() {
            this.hapusMedia(this.media.id)
            .then(() => {
                this.dialogHapus = false
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>