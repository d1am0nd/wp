import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/pages/Home'
import Card from '@/components/pages/Card'

Vue.use(Router)

export default new Router({
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
    }
  ]
})
