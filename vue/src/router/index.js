import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/pages/Home'
import Card from '@/components/pages/Card'
import Origin from '@/components/pages/Origin'

Vue.use(Router)

var router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/card/:slug',
      name: 'card',
      component: Card
    },
    {
      path: '/origin',
      name: 'origin',
      component: Origin
    }
  ]
})

export default router
