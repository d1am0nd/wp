import React from 'react';
import radium from 'radium';

import Cards from './Cards';
import Filters from './Filters';

import cardsApi from '../api/cards';

class Layout extends React.Component {
  constructor() {
    super();
    this.state = {
      cards: [],
      filters: {
        rarities: [],
        mechanics: [],
        playReqs: [],
        sets: [],
        types: [],
        classes: [],
      },
    };

    // Fetch cards
    cardsApi
      .getCards()
      .then(res => {
        this
          .setState({
            cards: res.data,
          });
      });

    // Fetch card attributes
    cardsApi
      .getAttributes()
      .then(res => {
        this
          .setState({
            filters: res.data,
          });
      });
  }

  visibleCards() {
    return this.state.cards.slice(0, 20);
  }

  handleFilterChange(type, id) {
    console.log(type, id);
  }

  render() {
    return (
      <div>
        Hi
        <Filters
          handleClick={this.handleFilterChange}
          filters={this.state.filters}/>
        <Cards
          cards={this.visibleCards()}/>
      </div>
    );
  }
}

export default radium(Layout);
