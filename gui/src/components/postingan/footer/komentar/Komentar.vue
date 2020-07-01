<template>
    <v-row
        no-gutters
        class="pa-2"
    >
        <v-col
            md="2"
            >
            <v-row
                justify="center"
                align="center"
            >
                <v-avatar>
                    <v-icon
                        class="grey lighten-1 white--text"
                    >
                        mdi-account
                    </v-icon>
                </v-avatar>
            </v-row>
        </v-col>
        <v-col
            md="10"
        >
            <v-card
                outlined
                class="rounded-lg"
            >
                <v-card-text
                    class="pa-2 text--primary"
                >
                    <div>
                        <b>Napoleon Boneparte</b> 
                    </div>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem alias ex quis totam debitis dolorum repudiandae temporibus perspiciatis consequatur. Sunt delectus laborum veritatis aliquid nulla minus. Facere rem saepe voluptates.
                </v-card-text>
            </v-card>
            <v-card-actions
                class="pa-1"
            >
                <div class="text-caption">
                    7 jam yang lalu
                </div>
                <v-spacer/>
                <v-btn
                    x-small
                    text
                    color="success"
                >
                    Edit
                </v-btn>
                <v-btn
                    x-small
                    text
                    color="error"
                >
                    Hapus
                </v-btn>
            </v-card-actions>
        </v-col>
    </v-row>
</template>