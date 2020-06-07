<template>
    <v-dialog
        v-model="muncul"
        max-width="500"
    >
        <template v-slot:activator="{on}">
            <v-btn
                outlined
                small
                color="primary"
                v-on="on"
            >
                Edit
            </v-btn>
        </template>
        <v-card>
            <v-card-text
                class="pa-3"
            >
                <v-textarea
                    filled
                    label="Ubah Isi"
                    v-model="form.isi"
                    :error-messages="error"
                />
            </v-card-text>
            <v-card-actions
                class="pa-3"
            >
                <v-spacer/>
                <v-btn
                    color="success"
                    outlined
                    small
                    @click="perbarui"
                >
                    Simpan perubahan
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    props : ['komentar'],
    data : () => ({
        muncul : false,
        error : '',
        form : {
            id : 0,
            isi : ''
        }
    }),
    created() {
        this.form = {
            id : this.komentar.id,
            isi : this.komentar.isi
        }
    },
    methods : {
        ...mapActions({
            perbaruiKomentar : 'perbaruiKomentar'
        }),
        perbarui() {
            this.perbaruiKomentar(this.form)
            .then(() => {
                this.muncul = false
            }).catch(() => {
                this.error = 'Terjadi masalah'
            })
        }
    }
}
</script>