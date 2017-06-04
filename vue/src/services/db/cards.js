import Vue from 'vue'

const GET_CARDS_URL = '/api/v2/cards'
const GET_ATTRIBUTES_URL = '/api/v2/cards/attributes'

export default {
  getAttributes () {
    return Vue.http.get(GET_ATTRIBUTES_URL)
  },

  getCards () {
    return Vue.http.get(GET_CARDS_URL)
  }
}
