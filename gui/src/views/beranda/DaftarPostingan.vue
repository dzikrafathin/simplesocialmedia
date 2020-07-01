<template>
    <container
        :berhasil="pesan.berhasil"
        :isi="pesan.isi"
        :tipe="pesan.tipe"
    >
        <Postingan />
    </container>
</template>

<script>
import Container from '../../components/standar/ContainerIndex'
import Postingan from '../../components/postingan/Postingan'

export default {
    components : {
        Container,
        Postingan
    },
    data : () => ({
        pesan : {
            berhasil : true,
            isi : 'Belum ada postingan yang dikirimkan',
            tipe : 'info'
        }
    })
}
</script>