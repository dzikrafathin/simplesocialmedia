<template>
    <v-dialog
        max-width="1200"
        v-model="dialog"
    >
        <template v-slot:activator="{on}">
            <v-btn
                small
                outlined
                class="mx-1"
                color="warning"
                v-on="on"
            >edit</v-btn>
        </template>
        <v-card
            
        >
            <v-card-title>
                Edit Postingan
            </v-card-title>
            <v-card-text>
                <v-textarea
                    label="Ubah isi"
                    auto
                    hide-details="auto"
                    outlined
                    v-model="form.isi"
                />
                <v-card-actions
                    class="px-0"
                >
                    <v-spacer/>
                    <v-btn
                        outlined
                        class="ma-0"
                        color="success"
                        small
                        @click="ubah"
                    >
                        Perbarui Isi
                    </v-btn>
                </v-card-actions>
                <EditMedia
                    :postinganId="postinganId"
                />
            </v-card-text>
            <v-card-actions>
                <v-spacer/>
                <hapus-postingan 
                    :postinganId="postinganId"
                />
                <v-btn
                    outlined
                    color="primary"
                    @click="dialog = false"
                >
                    Batal
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
import EditMedia from '../media/EditMedia'
import HapusPostingan from './HapusPostingan'

export default {
    props : ['postinganId','isi'],
    data : () => ({
        dialog : false,
        form : {
            id : 0,
            isi : ''
        }
    }),
    created() {
        this.form = {
            id : this.postinganId,
            isi : this.isi
        }
    },
    components : {
        EditMedia,
        HapusPostingan
    },
    computed : {
        ...mapGetters({
            getMedia : 'getMedia'
        })
    },
    methods : {
        ...mapActions({
            ubahPostingan : 'ubahPostingan'
        }),
        ubah() {
            this.ubahPostingan(this.form)
            .then(() => {
                this.dialog = false
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>