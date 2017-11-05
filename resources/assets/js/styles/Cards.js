export default class Cards {
  constructor() {

  }

  getCards() {
    return {
      'width': '100%',
      'display': 'flex',
      'flexWrap': 'wrap',
    };
  }

  getCardWrapper() {
    return {
      'width': '25%',
      'flexGrow': '1',
    };
  }

  getCard() {
    return {
      width: '100%',
    };
  }
}
