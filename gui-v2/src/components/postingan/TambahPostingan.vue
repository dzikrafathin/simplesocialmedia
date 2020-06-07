<template>
    <v-card class="mb-3">
        <v-card-text>
            <v-form id="postinganBaru">
                <v-textarea 
                    dense
                    name="isi"
                    rows="3"
                    :error-messages="error.isi"
                    prepend-icon="mdi-account"
                    outlined
                    label="Tulis status yang ingin dibuat"
                    auto-grow
                />
                <v-file-input
                    dense
                    outlined
                    :error-messages="error.media"
                    name="media[]"
                    multiple
                    chips
                    prepend-icon="mdi-camera"
                    hide-details="auto"
                    label="Upload Foto"
                    accept="image/*"
                ></v-file-input>
            </v-form>
        </v-card-text>
        <v-card-actions class="pa-3">
            <v-spacer/>
            <v-btn
                outlined
                @click="tambah"
                color="success"
            >Kirim</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    data : () => ({
        error : {
            isi : [],
            media : []
        }
    }),
    methods : {
        ...mapActions({
            tambahPostingan : 'tambahPostingan'
        }),
        tambah() {
            const data = new FormData(document.getElementById('postinganBaru'));
            this.tambahPostingan(data)
            .catch(err => {
                this.error = err
            })
        }
    }
}
</script>