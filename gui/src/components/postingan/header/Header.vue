<template>
    <v-row
        no-gutters
    >
        <v-col
            md="9"
        >
             <User 
                nama="Adolf Hitler"
                subjudul="2 jam yang lalu"
            />
        </v-col>
        <v-col
            md="3"
        >
            <aksi-postingan 
                class="my-2"
            />
        </v-col>
    </v-row>
</template>

<script>
import User from '../../standar/User'
import AksiPostingan from './AksiPostingan'

export default {
    components : {
        AksiPostingan,
        User
    }
}
</script>