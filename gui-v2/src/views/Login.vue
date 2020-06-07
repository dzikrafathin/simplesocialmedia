<template>
    <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card>
                <v-toolbar
                    color="blue"
                    dark
                    flat
                >
                    <v-toolbar-title>Login Pengguna</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-text-field
                        label="Alamat E-Mail"
                        v-model="user.email"
                        @focus="hapusError"
                        prepend-icon="mdi-account"
                        :error-messages="error.email"
                    ></v-text-field>
                    <v-text-field
                        label="Kata Sandi"
                        v-model="user.password"
                        @focus="hapusError"
                        :error-messages="error.password"
                        prepend-icon="mdi-lock"
                        type="password"
                    ></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary">Daftar</v-btn>
                    <v-btn 
                      color="success"
                      @click="cobaLogin"
                      >Login</v-btn>
                </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data : () => ({
    user : {
      email : '',
      password : ''
    },
    error : {
      email : '',
      password : ''
    }
  }),
  methods : {
    ...mapActions({
      login : 'login'
    }),
    cobaLogin() {
      this.login(this.user)
      .then(() => {
        this.$router.push('/')
      })
      .catch(err => {
        this.error = err.response.data
      })
    },
    hapusError() {
      this.error = {
        email : '',
        password : ''
      }
    }
  }  
}
</script>