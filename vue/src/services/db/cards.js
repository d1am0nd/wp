import Vue from 'vue'
import Errors from '@/errors'

const GET_CARDS_URL = '/api/v2/cards'
const GET_ATTRIBUTES_URL = '/api/v2/cards/attributes'

const CARDS_LS = 'cards'
const CARDS_EXPIRY_LS = 'expirty-cards'

export default {
  getAttributes () {
    return Vue.http.get(GET_ATTRIBUTES_URL)
  },

  getCards () {
    return new Promise((resolve, reject) => {
      if (localStorage.getItem(CARDS_LS) === null ||
        localStorage.getItem(CARDS_EXPIRY_LS) === null ||
        new Date(localStorage.getItem(CARDS_EXPIRY_LS)) < new Date()) {
        Vue.http.get(GET_CARDS_URL)
        .then((res) => {
          localStorage.setItem(CARDS_LS, res.body)
          localStorage.setItem(CARDS_EXPIRY_LS, new Date().setDate(new Date().getDate() + 1))
          resolve(JSON.parse(res.body))
        })
        .catch((err) => {
          Errors.newErrRes(err)
          reject(err)
        })
      } else {
        resolve(JSON.parse(localStorage.getItem(CARDS_LS)))
      }
    })
  }
}
