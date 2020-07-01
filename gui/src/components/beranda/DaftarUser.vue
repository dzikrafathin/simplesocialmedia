<template>
    <v-list>
        <User 
            nama="Josef Stalin"
            subjudul="stalin@yandex.ru"
            link
        />
        <User 
            nama="Bennito Mussolini"
            subjudul="musso@gmail.com"
            link
        />
        <User 
            nama="Napoleon Boneparte"
            subjudul="napoleon@gmail.com"
            link
        />
    </v-list>
</template>

<script>
import User from '../standar/User'

export default {
    components : {
        User
    }
}
</script>