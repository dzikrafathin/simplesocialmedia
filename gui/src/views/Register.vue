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
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Daftar User Baru</v-toolbar-title>
                <v-spacer />
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Nama"
                    name="nama"
                    v-model="login.nama"
                    prepend-icon="mdi-account"
                    type="text"
                  />
                  <v-text-field
                    label="Alamat E-Mail"
                    name="email"
                    v-model="login.email"
                    prepend-icon="mdi-email"
                    type="text"
                  />

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    v-model="login.password"
                    prepend-icon="mdi-lock"
                    type="password"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="primary" @click="register">Register</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    data: () => ({
        login : {
            nama: '',
            email:'',
            password:''
        }
    }),
    methods: {
        ...mapActions({
            globalRegister: 'register' // map `this.add()` to `this.$store.dispatch('increment')`
        }),
        register() {
            this.globalRegister(this.login)
            .then(() => {
              this.$router.push('/')
            })
        }
    }
}
</script>