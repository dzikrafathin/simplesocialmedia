<template>
    <div>
        <container>
            <buat-postingan/>
        </container>
        <daftar-postingan
            class="mt-4"
        />
    </div>
</template>

<script>
import Container from '../../components/standar/ContainerWithAlert'
import DaftarPostingan from './DaftarPostingan'
import BuatPostingan from '../../components/postingan/BuatPostingan'

export default {
    inject : ['menuBukaTutup'],
    components : {
        Container,
        DaftarPostingan,
        BuatPostingan
    },
    created() {
        this.menuBukaTutup(true)
    }
}
</script>