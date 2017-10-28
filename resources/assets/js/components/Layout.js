import React from 'react';
import radium from 'radium';

import Cards from './Cards';

import cardsApi from '../api/cards';

class Layout extends React.Component {
  constructor() {
    super();
    this.state = {
      cards: [],
    };

    cardsApi
      .getCards()
      .then(res => {
        this
          .setState({
            cards: res.data,
          });

        console.log(this.state.cards);
        console.log(res.data.length);
      });
  }

  visibleCards() {
    return this.state.cards.slice(0, 20);
  }

  render() {
    return (
      <div>
        Hi
        <Cards
          cards={this.visibleCards()}/>
      </div>
    );
  }
}

export default radium(Layout);
