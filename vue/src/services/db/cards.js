import Vue from 'vue'
import Errors from '@/errors'

const GET_CARDS_URL = '/api/v2/cards'
const GET_ATTRIBUTES_URL = '/api/v2/cards/attributes'

const CARDS_LS = 'cards'

export default {
  getAttributes () {
    return Vue.http.get(GET_ATTRIBUTES_URL)
  },

  getCards () {
    return new Promise((resolve, reject) => {
      if (localStorage.getItem(CARDS_LS) === null) {
        Vue.http.get(GET_CARDS_URL)
        .then((res) => {
          localStorage.setItem(CARDS_LS, res.body)
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
