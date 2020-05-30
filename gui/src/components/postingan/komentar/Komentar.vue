<template>
    <v-sheet
        
    >
        <User 
            :user="user" 
            :waktu="waktu"
        />
        <v-card-text
            class="py-1"
        >
            {{isi}}
        </v-card-text>
        <v-divider></v-divider>
    </v-sheet>
</template>

<script>
import User from '../../User.vue'

export default {
    props:['id','postinganId','postinganUserId','user','isi','waktu'],
    components : {
        User
    }
}
</script>