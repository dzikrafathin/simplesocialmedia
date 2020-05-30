<template>
            <v-list
                dense
                two-line
                class="px-3 py-0 ma-0"
            >
                <v-list-item
                    class="pa-0"
                >
                    <v-list-item-avatar
                        class="ma-1"
                        
                    >
                        <img 
                            v-if="user.foto != null"
                            :src="$rootURL + user.foto"
                        />
                        <v-icon
                            v-else
                            class="grey lighten-1 white--text"
                            >
                            mdi-account
                        </v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content
                        class="pa-0 pa-1"
                    >
                        <v-list-item-title>{{user.nama}}</v-list-item-title>
                        <v-list-item-subtitle>{{waktu}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
</template>

<script>
export default {
    props: ['user','waktu']
}
</script>