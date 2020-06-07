<template>
  <v-carousel
    v-if="adaFoto"
    cycle
    height="400"
    hide-delimiter-background
    show-arrows-on-hover
  >
    <v-carousel-item
      v-for="media in getMedia(postinganId)"
      :key="media.id"
    >
      <v-img
        height="100%"
        :src="$baseURL + media.url"
        contain
      ></v-img>
    </v-carousel-item>
  </v-carousel>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
  props : ['postinganId'],
  data : () => ({
    adaFoto : false
  }),
  created() {
    this.indexMedia(this.postinganId)
    .then((res) =>{
      if (res) {
        this.adaFoto = true
      }
    })
  },
  methods : {
    ...mapActions({
      indexMedia : 'indexMedia'
    })
  },
  computed : {
    ...mapGetters({
      getMedia: 'getMedia'
    })
  }
}
</script>