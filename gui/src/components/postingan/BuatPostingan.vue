<template>
    <v-card>
        <v-card-text>
            <v-form id="buat">
                <v-textarea
                    outlined
                    dense
                    name="isi"
                    rows="3"
                    :error-messages="errors.isi"
                    class="mb-2"
                    hide-details="auto"
                    prepend-icon="mdi-comment-text"
                    label="Tuliskan Postingan yang ingin dibuat"
                ></v-textarea>
                <v-file-input
                    outlined
                    hide-details="auto"
                    dense
                    :error-messages="errors.media"
                    multiple
                    name="media[]"
                    chips
                    prepend-icon="mdi-camera"
                    label="Upload Foto"
                ></v-file-input>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer/>
            <v-btn
                small
                text
                color="primary"
                @click="testingPesan"
            >Kirim</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    inject : ['pesanError'],
    data : () => ({
        errors : {
            isi : [],
            media : []
        }
    }),
    methods : {
        kirimBuat() {
            
        }
    }
}
</script>