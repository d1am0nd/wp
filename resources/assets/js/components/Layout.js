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
      search: '',
      filters: {
        rarities: [],
        mechanics: [],
        playReqs: [],
        sets: [],
        types: [],
        classes: [],
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
        if (i.name.toLowerCase()
            .indexOf(this.state.search.toLowerCase()) === -1) {
          return false;
        }
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

  handleSearchChange(e) {
    this.setState({
      search: e.target.value,
      visibleCards: this.visibleCards(this.state.cards),
    });
  }

  handleFilterChange(type, name) {
    this.Filters.toggle(type, name);
    this.setState({
      visibleCards: this.visibleCards(this.state.cards),
    });
  }

  render() {
    return (
      <div style={{height: '100%'}}>
        <Sidebar
          handleSearchChange={this.handleSearchChange.bind(this)}
          handleClick={this.handleFilterChange.bind(this)}
          show={this.Filters}
          filters={this.state.filters}/>
        <div style={{marginLeft: '28%'}}>
          <Cards
            cards={this.state.visibleCards}/>
        </div>
      </div>
    );
  }
}

export default radium(Layout);
