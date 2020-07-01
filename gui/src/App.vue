<template>
  <v-app>
    <v-navigation-drawer 
      app
      right
      clipped
      v-model="drawer"
    >
      <DaftarUser />
    </v-navigation-drawer>
    <v-app-bar 
      app
      clipped-right  
      color="blue"
      dark
    >
      <v-app-bar-nav-icon>
        <v-icon
        >
          mdi-account-group
        </v-icon>
      </v-app-bar-nav-icon>
      <v-toolbar-title>
        Sosmed
      </v-toolbar-title>
    </v-app-bar>
    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import DaftarUser from './components/beranda/DaftarUser'

export default {
  components : {
    DaftarUser
  },
  data : () => ({
    drawer : false
  }),
  computed : {
    ...mapGetters({
      sudahMasuk : 'sudahMasuk'
    })
  },
  methods : {
    ...mapActions({
      lihat : 'lihat'
    }),
    menuBukaTutup(bool) {
      this.drawer = bool
    } 
  },
  created() {
    if (this.sudahMasuk) {
      this.lihat()
    }
  },
  provide : function() {
    return {
      menuBukaTutup : this.menuBukaTutup
    }
  }
}
</script>