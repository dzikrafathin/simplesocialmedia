<template>
    <v-card>
        <v-card-text class="px-2 pt-4 pb-0">
            <v-form id="inputData">
                <v-textarea
                    
                    dense
                    name="isi"
                    rows="3"
                    hide-details="auto"
                    label="Tulis Postingan Baru"
                    prepend-icon="mdi-pencil"
                ></v-textarea>
                <v-file-input
                    label="Tambahkan Foto"
                    
                    dense
                    hide-details="auto"
                    name="media[]"
                    small-chips
                    multiple
                    prepend-icon="mdi-camera"
                ></v-file-input>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer/>
            <v-btn 
                text
                @click="uploadPosting"
                >Upload</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>

export default {
    props : ['tambah'],
    methods: {
        uploadPosting : function() {
            var form = document.getElementById('inputData');
            var data = new FormData(form)
            this.tambah(data);
        }
    }
}
</script>