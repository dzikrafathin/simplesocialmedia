import Vue from 'vue'
import VueRouter from 'vue-router'
import Beranda from '../views/Beranda.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    component: Beranda,
    children : [
      {
        path : '',
        name: 'Beranda Postingan',
        component : () => import('../views/beranda/BerandaPostingan.vue')
      },
      {
        path : 'profil',
        component : () => import('../views/profil/Profil.vue'),
        children : [
          {
            path : '',
            name : 'Biodata User',
            component : () => import('../views/profil/Biodata.vue')
          },
          {
            path : 'foto',
            name : 'Galeri Foto',
            component : () => import('../views/profil/GaleriFoto.vue')
          }
        ]
      }
    ]
  },
  {
    path : '/login',
    name : 'Halaman Login',
    component : () => import('../views/login/Base.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
