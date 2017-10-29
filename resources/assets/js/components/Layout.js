import React from 'react';
import radium from 'radium';

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
    };

    this.show = {
        rarities: {},
        mechanics: {},
        playReqs: {},
        sets: {},
        types: {},
        classes: {},
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

          this.types.forEach(type => {
            res.data[type.multi].forEach(i => {
              this.show[type.multi][i.name] = true;
            });
          });
      });
  }

  visibleCards(cards) {
    return cards
      .filter(i => {
        let r = true;
        this.types.forEach(type => {
          let toShow = this.show[type.multi][i[type.single]];
          if (toShow === false || typeof toShow === 'undefined') {
            r = false;
          }
        });
        return r;
      })
      .slice(0, 20);
  }

  handleFilterChange(type, name) {
    this.show[type][name] = !this.show[type][name];
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
