import axios from 'axios';

const CARDS_URL = '/api/v2/cards';
const CARD_ATTRIBUTES_URL = '/api/v2/cards/attributes';

export default {
  getCards() {
    return new Promise((resolve, reject) => {
      return axios
        .get(CARDS_URL)
        .then(res => {
          resolve(res);
        })
        .catch(err => {
          reject(err);
        });
    });
  },
  getAttributes() {
    return new Promise((resolve, reject) => {
      return axios
        .get(CARD_ATTRIBUTES_URL)
        .then(res => {
          resolve(res);
        })
        .catch(err => {
          reject(err);
        });
    });
  },
};
