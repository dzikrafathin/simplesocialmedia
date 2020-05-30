<template>
    <v-card>
        <v-img
            :src="$rootURL + user.foto"
            height="200px"
        >
            <v-row
                align="end"
                class="fill-height"
            >
                <v-col
                    class="py-0"
                >
                    <v-list-item
                        color="rgba(0, 0, 0, .4)"
                        dark
                    >
                        <v-list-item-content>
                            <v-list-item-title class="title">{{user.nama}}</v-list-item-title>
                            <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-col>
            </v-row>
        </v-img>
        <v-card-text
            class="pa-0"
        >
            <v-list
                dense
            >
                <v-list-item
                    v-for="(m,i) in menu"
                    link
                    :key="i"
                >
                    <v-list-item-icon>
                        <v-icon>
                        {{m.icon}}
                        </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{m.judul}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props : ['id'],
    data : () => ({
        user : {},
        menu : [
            {
                judul: 'Profil',
                icon: 'mdi-account'
            },
            {
                judul: 'Foto',
                icon: 'mdi-camera'
            },
            {
                judul : 'Postingan',
                icon : 'mdi-pencil'
            }
        ]
    }),
    created() {
        this.$http.get('user/'+this.id)
        .then(res => {
            this.user = res.data
        })
    }
}
</script>