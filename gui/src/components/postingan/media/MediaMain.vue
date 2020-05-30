<template>
  <v-carousel
    cycle
    height="400"
    hide-delimiter-background
    show-arrows-on-hover
    v-if="daftarMedia.length > 0"
  >
    <v-carousel-item
      v-for="media in daftarMedia"
      :key="media.id"
      :src="$rootURL + media.url"
    >
    </v-carousel-item>
  </v-carousel>
</template>

<script>
  export default {
    props : ['postinganId','postinganUserId'],
    created() {
      this.$http.get('postingan/'+this.postinganId+'/media')
      .then(res => {
        this.daftarMedia = res.data
      })
    },
    data () {
      return {
        daftarMedia : []
      }
    },
  }
</script>