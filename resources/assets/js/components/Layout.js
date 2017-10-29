import React from 'react';
import radium from 'radium';

import Filters from '../filter';

import Cards from './Cards';
import Sidebar from './Sidebar';

import cardsApi from '../api/cards';

class Layout extends React.Component {
  constructor() {
    super();
    this.state = {
      cards: [],
      visibleCards: [],
      filters: {
        rarities: [],
        mechanics: [],
        playReqs: [],
        sets: [],
        types: [],
        classes: [],
      },
      show: {
        rarities: {},
        mechanics: {},
        playReqs: {},
        sets: {},
        types: {},
        classes: {},
      },
    };

    this.types = [
      {
        multi: 'types',
        single: 'type',
      },
      {
        multi: 'rarities',
        single: 'rarity',
      },
      {
        multi: 'sets',
        single: 'set',
      },
      {
        multi: 'classes',
        single: 'class',
      },
    ];

    this.Filters = new Filters();

    // Fetch cards
    cardsApi
      .getCards()
      .then(res => {
        this
          .setState({
            cards: res.data,
            visibleCards: this.visibleCards(res.data),
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

          this.Filters.setFilters(res.data);
      });
  }

  visibleCards(cards) {
    return cards
      .filter(i => {
        let r = true;
        this.types.forEach(type => {
          let toShow = this.Filters.showCard(type.multi, i[type.single]);
          if (toShow === false || typeof toShow === 'undefined') {
            r = false;
          }
        });
        return r;
      })
      .slice(0, 20);
  }

  countSelected(type) {
    let count = 0;
    for (let prop in this.state.show[type]) {
      if (this.state.show[type].hasOwnProperty(prop) &&
        this.state.show[type][prop] === true) {
        count++;
      }
    }
    return count;
  }

  selectAll(type) {
    for (let prop in this.state.show[type]) {
      if (this.state.show[type].hasOwnProperty(prop)) {
        this.state.show[type][prop] = true;
      }
    }
  }

  handleFilterChange(type, name) {
    this.Filters.toggle(type, name);
    this.setState({
      visibleCards: this.visibleCards(this.state.cards),
    });
  }

  render() {
    return (
      <div>
        Hi
        <Sidebar
          handleClick={this.handleFilterChange.bind(this)}
          show={this.Filters}
          filters={this.state.filters}/>
        <div style={{marginLeft: '25%'}}>
          <Cards
            cards={this.state.visibleCards}/>
        </div>
      </div>
    );
  }
}

export default radium(Layout);
