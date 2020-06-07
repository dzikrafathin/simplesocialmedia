<template>
    <v-card
        outlined
    >
        <v-card-title>Media Postingan</v-card-title>
        <v-card-text>
            <v-row>
                <ItemMedia 
                    v-for="media in getMedia(postinganId)"
                    :key="media.id"
                    :media="media"
                />
            </v-row>
        </v-card-text>
        <v-card-actions>
            <v-spacer/>
            <v-dialog
                max-width="500"
                v-model="dialogTambah"
            >
                <template v-slot:activator="{on}">
                    <v-btn
                        small
                        color="primary"
                        outlined
                        v-on="on"
                    >
                        Upload Foto baru
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        Tambah Foto
                    </v-card-title>
                    <v-card-text>
                        <v-form
                            :id="`foto${postinganId}`"
                        >
                            <v-file-input
                                dense
                                outlined
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
                    <v-card-actions>
                        <v-spacer/>
                        <v-btn
                            x-small
                            color="success"
                            outlined
                            @click="tambah"
                        >
                            Upload
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card-actions>
    </v-card>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
import ItemMedia from './ItemMedia'

export default {
    props : ['postinganId'],
    components : {
        ItemMedia
    },
    data : () => ({
        dialogTambah : false
    }),
    computed : {
        ...mapGetters({
            getMedia : 'getMedia'
        })
    },
    methods : {
        ...mapActions({
            tambahMedia : 'tambahMedia'
        }),
        tambah() {
            var media = new FormData(document.getElementById(`foto${this.postinganId}`))
            var data = {
                id : this.postinganId,
                data : media
            }
            this.tambahMedia(data)
            .then(() => {
                this.dialogTambah = false
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>