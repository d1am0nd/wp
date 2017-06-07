import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/pages/Home'
import Advanced from '@/components/pages/Advanced'
import Card from '@/components/pages/Card'
import Origin from '@/components/pages/Origin'
import VueAnalytics from 'vue-analytics'

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
      path: '/advanced',
      name: 'advanced',
      component: Advanced
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

Vue.use(VueAnalytics, {
  id: 'UA-74992400-1',
  router
})

export default router
