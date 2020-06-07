<template>
  <!-- App.vue -->
  <v-app>
    <v-navigation-drawer 
      app
      :clipped="$vuetify.breakpoint.lgAndUp"
      v-model="drawer"
      >
      <v-list
        nav
      >
        <v-list-item 
          link
          :to="{path:'/'}"
          >
          <v-list-item-content>
              <v-list-item-title>Beranda</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item 
          link
          :to="{path:'/profile'}"
          >
          <v-list-item-content>
              <v-list-item-title>Profil</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-content>
              <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar 
      app
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      color="blue"
      dark
      >
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>{{$route.name}}</v-toolbar-title>
      <v-spacer/>
      <UserLogin />
    </v-app-bar>

    <!-- Sizes your content based upon application components -->
    <v-content>
        <!-- If using vue-router -->
      <router-view></router-view>

    </v-content>

    <v-footer app>
      <!-- -->
    </v-footer>
  </v-app>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import UserLogin from './components/user/UserLogin.vue'

export default {
  components : {
    UserLogin
  },
  created() {
    if (this.isLoggedIn) {
      this.isiUser()
    }
  },
  data() {
    return {
      drawer : false
    }
  },
  computed : {
    ...mapGetters({
      isLoggedIn : 'isLoggedIn'
    })
  },
  methods : {
    ...mapActions({
      isiUser: 'isiUser'
    })
  }
}
</script>