<template>
    <div>
        <v-textarea
          outlined
          rows="1"
          label="Tuliskan Komentar"
          class="ma-2"
          dense
          v-model="isi"
          auto-grow
          hide-details="auto"
        ></v-textarea>
        <v-card-actions
            class="pt-0 pb-3"
        >

            <v-btn
                small
                color="success"
                :outlined="show ? false : true"
                @click="show = !show"
            >
                {{daftarKomentar.length}} Komentar
                <v-icon 
                    small 
                    right 
                    :dark="show ? false : true"
                    >
                    {{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                </v-icon>
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn
                small
                color="success"
                @click="create"
            >
                Kirim Komentar
                <v-icon small right dark>mdi-send</v-icon>
            </v-btn>            
            
        </v-card-actions>
        <v-expand-transition>
            <div v-show="show">
                <v-divider></v-divider>

                <v-card-text>
                    <Komentar 
                        v-for="komentar in daftarKomentar"
                        :key="komentar.id"
                        :id="komentar.id"
                        :postinganId="komentar.postingan_id"
                        :postinganUserId="postinganUserId"
                        :user="komentar.user"
                        :isi="komentar.isi"
                        :waktu="komentar.created_at"
                    />
                </v-card-text>
            </div>
        </v-expand-transition>
    </div>
</template>

<script>
import Komentar from '../komentar/Komentar.vue'

export default {
    props: ['postinganId','postinganUserId'],
    components : {
        Komentar
    },
    created() {
        this.$http.get('postingan/'+this.postinganId+'/komentar')
        .then(res => {
            this.daftarKomentar = res.data
        })
    },
    data: () => ({
      show: false,
      daftarKomentar: [],
      isi: ''
    }),
    methods : {
        create() {
            this.$http.post(
                'postingan/'+this.postinganId+'/komentar',
                {
                    isi : this.isi
                }
            ).then(res => {
                this.daftarKomentar.push(res.data)
            })
        }
    }
}
</script>