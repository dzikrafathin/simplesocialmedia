<template>
  <v-container
    fluid
  >
    <v-row
      align="start"
      justify="center"
    >
      <v-col
        md="3"
      >
        <menu-kiri/>
      </v-col>
      <v-col
        md="6"
      >
        <router-view />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import MenuKiri from '../components/beranda/MenuKiri'

export default {
  components : {
    MenuKiri,
  }
}
</script>