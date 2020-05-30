<template>
  <v-container fluid>
    <v-row>
      <v-col
        md="8"
      >
        <PostinganMain/>
      </v-col>
      <v-col
        md="4"
      >

      </v-col>
    </v-row>      
  </v-container>
</template>

<script>
// @ is an alias to /src
import PostinganMain from '../components/postingan/PostinganMain.vue'

export default {
  name: 'Home',
  components: {
    PostinganMain
  }
}
</script>
