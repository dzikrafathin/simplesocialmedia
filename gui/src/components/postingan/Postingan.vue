<template>
    <v-card>
        <Header />
        <Body />
        <Footer />
        <v-overlay
            absolute
            :value="overlayValue"
            z-index="3"
        >
            <v-card
                light
            >
                <v-card-text class="text--primary">
                    Anda yakin ingin menghapus postingan ini ?
                </v-card-text>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn
                        small
                        outlined
                        color="success"
                        @click="toggleOverlay"
                    >Batal</v-btn>
                    <v-btn
                        small
                        color="error"
                    >Hapus</v-btn>
                </v-card-actions>
            </v-card>
        </v-overlay>
    </v-card>
</template>

<script>
import Header from './header/Header'
import Body from './body/Body'
import Footer from './footer/Footer'

export default {
    components : {
        Header,
        Body,
        Footer
    },
    data : () => ({
        overlayValue : false
    }),
    methods : {
        toggleOverlay() {
            this.overlayValue = !this.overlayValue
        }
    },
    provide : function() {
        return {
            toggleOverlay : this.toggleOverlay
        }
    }
}
</script>