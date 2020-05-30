<template>
    <div>
        <v-card-actions>
            <v-btn
                small
                color="primary"
                :outlined="userLike.disukai ? false : true"
                @click="toggleSuka"
            >
                {{userLike.disukai ? 'Disukai' : 'Suka'}}
                <v-icon small right dark>mdi-thumb-up</v-icon>
            </v-btn>
            
            <v-spacer></v-spacer>

            <v-btn
                small
                color="primary"
                :outlined="show ? false : true"
                @click="show = !show"
            >
                {{daftarSuka.length}} Suka
                <v-icon 
                    small 
                    right 
                    :dark="show ? false : true"
                    >
                    {{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                </v-icon>
            </v-btn>

            
        </v-card-actions>

        <v-expand-transition>
        <div v-show="show">
            <v-divider></v-divider>

            <v-card-text>
                <User 
                    v-for="suka in daftarSuka"
                    :key="suka.id"
                    :user="suka.user"
                    :waktu="suka.created_at"/>
            </v-card-text>
        </div>
        </v-expand-transition>
    </div>
</template>

<script>
import User from '../../User.vue'

export default {
    props : ['postinganId'],
    components : {
        User
    },
    created() {
        this.$http.get('postingan/'+this.postinganId+'/like')
        .then(res => {
            this.daftarSuka = res.data.daftarSuka
            this.userLike = res.data.userLike
        })
    },
    data: () => ({
      show: false,
      userLike: {
          disukai : false,
          likeId : 0
      },
      daftarSuka: []
    }),
    methods: {
        toggleSuka : function() {
            if (this.userLike.disukai) {
                this.$http.delete(
                    '/like/'+this.userLike.likeId
                ).then(() => {
                    const i = this.daftarSuka.map(item => item.id).indexOf(this.userLike.likeId);
                    this.daftarSuka.splice(i,1);

                    this.userLike.disukai = false
                    this.userLike.likeId = 0
                })
            } else {
                this.$http.post(
                    '/postingan/'+this.postinganId+'/like'
                ).then(res => {
                    this.userLike.likeId = res.data.id
                    this.userLike.disukai = true
                    
                    this.daftarSuka.push(res.data)
                })
            }
        }
    }
}
</script>