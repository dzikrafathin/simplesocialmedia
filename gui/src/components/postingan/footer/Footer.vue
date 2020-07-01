<template>
    <div>
        <data-postingan />
        <v-divider/>
        <v-expand-transition> 
            <div
                v-show="tampilDaftarKomentar"
            >   
                <container-index
                    :berhasil="false"
                    isi="Belum ada komentar"
                    tipe="info"
                >
                    <daftar-komentar />
                </container-index>
            </div>
        </v-expand-transition>
        <v-divider/>
        <tambah-komentar/>
    </div>
</template>

<script>
import DataPostingan from './DataPostingan'
import DaftarKomentar from './komentar/DaftarKomentar'
import TambahKomentar from './komentar/TambahKomentar'
import ContainerIndex from '../../standar/ContainerIndex'

export default {
    components : {
        DataPostingan,
        TambahKomentar,
        ContainerIndex,
        DaftarKomentar
    },
    data : () => ({
        tampilDaftarKomentar : false
    }),
    methods : {
        toggleDaftarKomentar() {
            this.tampilDaftarKomentar = !this.tampilDaftarKomentar
        }
    },
    provide : function() {
        return {
            toggleDaftarKomentar : this.toggleDaftarKomentar
        }
    }
}
</script>