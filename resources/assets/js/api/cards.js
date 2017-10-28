import axios from 'axios';

const CARDS_URL = '/api/v2/cards';

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
};
