import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import Axios from 'axios'

Vue.config.productionTip = false

Vue.prototype.$rootURL = 'http://localhost:8000/'
Vue.prototype.$http = Axios
Vue.prototype.$http.defaults.baseURL = 'http://localhost:8000/api/'

const token = localStorage.getItem('token')

if (token) {
  Vue.prototype.$http.defaults.headers.common['Authorization'] = `Bearer ${token}`
  store.dispatch('user_info')
}

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
