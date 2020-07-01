<template>
    <div>
        <v-snackbar
            v-model="snackbar.muncul"
            :color="snackbar.tipe"
            top
        >
            <v-icon
                class="pr-2"
            >mdi-information</v-icon>
            {{snackbar.isi}}
        </v-snackbar>
        <v-alert
            :type="tipe"
            v-model="muncul"
            transition="fade-transition"
            dismissible
        >
            {{isi}}
        </v-alert>
        <slot
            v-if="!gagal"
        ></slot>
    </div>
</template>

<script>
export default {
    data : () => ({
        tipe : "error",
        isi : "",
        gagal : false,
        muncul : false,
        snackbar : {
            tipe : "success",
            isi : "",
            muncul : false
        }
    }),
    methods : {
        pesanError(isi) {
            this.tipe = "error"
            this.muncul = true
            this.isi = isi
        },
        pesanSukses(isi) {
            this.muncul = true
            this.tipe = "success"          
            this.isi = isi
            setTimeout(() => {
                this.muncul = false
            },1000);
        },
        snackbarSukses(isi) {
            this.snackbar = {
                tipe : "success",
                isi : isi,
                muncul : true
            }
        },
        pesanGagal(isi) {
            this.pesanError(isi)
            this.gagal = true
        },
        pesanInfo(isi) {
            this.tipe = "info"
            this.muncul = true
            this.isi = isi
        },
        sembunyikanPesan() {
            this.muncul = false
        }
    },
    provide : function() {
        return {
            pesanError : this.pesanError,
            pesanInfo : this.pesanInfo,
            pesanGagal : this.pesanGagal,
            pesanSukses : this.pesanSukses,
            sembunyikanPesan : this.sembunyikanPesan
        }
    }
}
</script>