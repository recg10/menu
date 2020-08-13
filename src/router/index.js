import Vue from 'vue'
import Router from 'vue-router'

import Empresa from '@/components/Empresa.vue'
import Menu from '@/components/Menu.vue'
import QR from '@/components/qr.vue'

Vue.use(Router)

export default new Router({
  routes: [
      {
        path: '/',
        component: Empresa
      },
      {
        path: '/menu',
        component: Menu
      },
      {
        path: '/qr',
        component: QR
      }
    ],
  linkActiveClass: 'active',
  mode: 'history',
  base: '/menu/'
})
