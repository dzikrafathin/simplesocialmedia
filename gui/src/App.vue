<template>
  <v-app>
    <v-navigation-drawer 
      app
      v-model="drawer"
      >
      <v-list two-line subheader dense>
        <v-list-item v-if="isLoggedIn">
          <v-list-item-avatar>
             <img 
              v-if="user.foto != null"
              :src="$rootURL + user.foto" />
            <v-icon
              v-else
              class="grey lighten-1 white--text"
              >
              mdi-account
            </v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title >{{this.user.nama}}</v-list-item-title>
            <v-list-item-subtitle >{{this.user.email}}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-else>
          <v-list-item-avatar color="grey">
             
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title >Guest</v-list-item-title>
            <v-list-item-subtitle >Guest User</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
      </v-list>
      <v-list>
        <v-list-item
          v-for="(m,i) in menu"
          link
          :key="i"
        >
          <v-list-item-icon>
            <v-icon>
              {{m.icon}}
            </v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>{{m.judul}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar 
      app
      dark
      color="primary"
      >
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Sosmed</v-toolbar-title>
      <v-spacer></v-spacer>
        <template v-if="isLoggedIn">
          <v-avatar 
            color="grey" size="48">
            <img 
              v-if="user.foto != null"
              :src="$rootURL + user.foto" />
            <v-icon
              v-else
              class="grey lighten-1 white--text"
              >
              mdi-account
            </v-icon>
          </v-avatar>

        </template>
        <template v-else>
            <v-btn class="mx-1" color="secondary" dark>Login</v-btn>
            <v-btn class="mx-1" color="success" dark>Register</v-btn>
        </template>
    </v-app-bar>
    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>

<script>
import {mapState, mapGetters} from 'vuex'

export default {
  data: () => ({
    drawer: false,
    menu : [
      {
        judul: 'Beranda',
        icon: 'mdi-home'
      },
      {
        judul: 'Profil',
        icon: 'mdi-account'
      },
      {
        judul : 'Logout',
        icon : 'mdi-exit-to-app'
      }
    ]
  }),
  created() {
    
  },
  computed: {
    ...mapState({
      user: state => state.user,
    }),
    ...mapGetters({
      isLoggedIn : 'isLoggedIn'
    })
  }
}
</script>