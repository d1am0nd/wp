// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import cards from '@/services/data/cards'
import router from './router'
import VueResource from 'vue-resource'
import VueLazyload from 'vue-lazyload'
import 'skeleton-css/css/normalize.css'
import 'skeleton-css/css/skeleton.css'
import './styles/main.scss'

import Errors from '@/errors'
import cardService from '@/services/db/cards'
import Attributes from '@/services/data/cardattributes'

Vue.config.productionTip = false
Vue.use(VueResource)
Vue.use(VueLazyload)

/* eslint-disable no-new */
var vm = new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App },
  created () {
    cardService.getAttributes()
    .then((res) => {
      if (res.status === 200) {
        this.cards.attributes.setAttributes(JSON.parse(res.body))
      }
    })
    .catch((err) => {
      Errors.newErrRes(err)
    })

    cardService.getCards()
    .then((res) => {
      this.cards.cards.setCards(res)
    })
    .catch((err) => {
      Errors.newErrRes(err)
    })
  },
  data () {
    return {
      cards: {
        attributes: Attributes.newAttributes({}),
        cards: cards.newCards([])
      }
    }
  }
})

router.beforeEach((to, from, next) => {
  vm.cards.attributes.resetAll()
  next()
})
