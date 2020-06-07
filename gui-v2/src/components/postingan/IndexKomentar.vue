<template>
        <v-expand-transition>
            <div v-show="show">
                <v-divider></v-divider>
                <template v-if="loading">
                    <v-skeleton-loader
                        class="mx-auto"
                        type="card"
                    ></v-skeleton-loader>
                </template>
                <template v-else>
                    <template v-if="adaKomentar">
                        <Komentar 
                            v-for="komentar in getKomentar(postinganId)"
                            :key="komentar.id"
                            :komentar="komentar"
                        />
                    </template>
                    <template v-else>
                        <v-alert 
                            class="ma-3"
                            outlined
                            type="info"
                            >
                            Belum ada komentar
                        </v-alert>
                    </template>
                </template>
            </div>
        </v-expand-transition>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
import Komentar from './Komentar.vue'

export default {
    components : {
        Komentar
    },
    props : ['show','postinganId'],
    data : () => ({
        loading : false
    }),
    computed : {
        ...mapGetters({
            getKomentar : 'getKomentar'
        }),
        adaKomentar() {
            return this.getKomentar(this.postinganId).length > 0
        }
    },
    methods : {
        ...mapActions({
            indexKomentar : 'indexKomentar'
        }),
        mulai() {
            this.indexKomentar(this.postinganId)
            .then(() => {
                this.loading = false
            }).catch(err => {
                console.log(err)
            });
            this.loading = true;
        }
    },
    watch : {
        show : function() {
            if (this.show) {
                this.mulai()
            }
        }
    }
}
</script>