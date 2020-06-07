<template>
    <div>
        <v-card-actions
            class="pa-3"
        >
            <v-btn
                small
                color="primary"
                :outlined="disukai ? false : true"
                @click="toggleSuka"
            >{{ statusSuka }}</v-btn>
            
            <edit-postingan
                v-if="bisaDiEdit"
                :postinganId="postinganId"
                :isi="isi"
            ></edit-postingan>
            
            <v-spacer/>
            <v-btn
                small
                color="success"
                outlined
                @click="lihatKomentar = !lihatKomentar"
                class="mr-1"
            >
                {{data.jumlahKomentar}} Komentar
            </v-btn>
            <index-suka
                :jumlah="data.jumlahSuka"
                :postinganId="postinganId"
            />
        </v-card-actions>
        <index-komentar
            :show="lihatKomentar"
            :postinganId="postinganId"
        />
        <v-divider/>
        <v-card-actions
            class="pa-3"
        >
            <v-textarea 
                v-model="komentar.isi"
                dense
                required
                outlined
                hide-details="auto"
                prepend-icon="mdi-comment"
                label="Tulis Komentar"
                rows="1"
                :error-messages="errorKomentar"
                auto-grow
                v-on:keyup.enter="kirimKomentar"
            />
        </v-card-actions>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
import IndexKomentar from './IndexKomentar.vue'
import IndexSuka from './IndexSuka.vue'
import EditPostingan from './EditPostingan.vue'

export default {
    props : ['data','postinganId','bisaDiEdit','isi'],
    data : () => ({
        lihatKomentar : false,
        disukai : false,
        likeId : 0,
        errorKomentar : [],
        komentar : {
            isi : ''
        },
    }),
    created() {
        if (this.data.suka != null) {
            this.disukai = true;
            this.likeId = this.data.suka
        }
    },
    components : {
        IndexKomentar,
        IndexSuka,
        EditPostingan
    },
    computed : {
        statusSuka() {
            return this.disukai ? 'Disukai' : 'Suka';
        },
        adaSuka() {
            return this.data.jumlahSuka > 0
        },
        adaKomentar() {
            return this.data.jumlahKomentar > 0
        }
    },
    methods : {
        toggleSuka() {
            if (this.disukai) {
                this.tidakSukai(this.likeId)
                .then(() => {
                    this.disukai = false
                    this.likeId = 0
                })
            } else {
                this.sukai(this.postinganId)
                .then(res => {
                    this.disukai = true
                    this.likeId = res.id
                })
            }
        },
        kirimKomentar() {
            this.tambahKomentar({
                postinganId : this.postinganId,
                komentar : this.komentar
            })
            .then(() => {
                this.lihatKomentar = true
            })
            .catch((err) => {
                this.errorKomentar = err
            })
        },
        ...mapActions({
            sukai : 'sukai',
            tidakSukai : 'tidakSukai',
            tambahKomentar : 'tambahKomentar'
        })
    }
}
</script>