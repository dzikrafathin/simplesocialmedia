import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Beranda',
    component: () => import('../views/IndexPostingan.vue')
  },
  {
    path: '/user/:id',
    name: 'Profil User',
    component: () => import('../views/UserProfile.vue')
  },
  {
    path: '/login',
    name: 'Halaman Login',
    component: () => import('../views/Login.vue')
  },
  {
    path: '/register',
    name: 'Halaman Registrasi',
    component: () => import('../views/Register.vue')
  },
  {
    path: '/profile',
    name : 'Profil Pribadi',
    component: () => import('../views/Profile.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
