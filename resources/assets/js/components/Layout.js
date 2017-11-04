import React from 'react';
import radium from 'radium';

import Filters from '../filter';

import {StyleRoot} from 'radium';

import Cards from './Cards';
import Sidebar from './Sidebar';
import TopLine from './layout/TopLine';
import SingleCard from './SingleCard';

import LayoutStyle from '../styles/layout';

import cardsApi from '../api/cards';

class Layout extends React.Component {
  constructor() {
    super();
    this.styles = new LayoutStyle(true);
    this.state = {
      cards: [],
      visibleCards: [],
      show: 12,
      search: '',
      selectedCard: null,
      filters: {
        rarities: [],
        mechanics: [],
        playReqs: [],
        sets: [],
        types: [],
        classes: [],
      },
      sidebarOpen: true,
    };
    // This is used to track dragging state
    this.dragStart = 0;

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
        let path = window.location.pathname;
        let match = path.match(/^\/card\/([A-z-]*)\/?$/);
        let selectedCard = null;
        if (match !== null) {
          let slug = match[1];
          let card = res.data.find(i => {
            return i.slug == slug;
          });
          if (typeof card !== 'undefined') {
            selectedCard = card;
          }
        }
        this
          .setState({
            cards: res.data,
            visibleCards: this.visibleCards(res.data),
            selectedCard: selectedCard,
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

  topLineStyles() {
    return this.styles.getTopLineStyle();
  }

  leftStyles() {
    return this.styles.getLeft();
  }

  rightStyles() {
    return this.styles.getRight();
  }

  toggleIconStyles() {
    return this.styles.getToggleIcon();
  }

  toggleSidebar() {
    this.styles.setSidebar(!this.state.sidebarOpen);
    this.setState({
      sidebarOpen: !this.state.sidebarOpen,
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
      });
  }

  clearFilterType(type) {
    this.Filters.resetType(type);
    this.setState({
      visibleCards: this.visibleCards(this.state.cards),
    });
  }

  handleCardClick(e, card) {
    if (this.state.selectedCard === null) {
      this.setState({
        selectedCard: card,
      });
    }
  }

  handleContentClick(e) {
    if (this.state.selectedCard) {
      this.setState({
        selectedCard: null,
      });
    }
  }

  handleSearchChange(e) {
    this.state.search = e.target.value;
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
      <StyleRoot
        style={{height: '100%'}}>
        <i
          className="fa fa-chevron-circle-right"
          onClick={e => this.toggleSidebar()}
          style={this.toggleIconStyles()}>
        </i>
        <SingleCard card={this.state.selectedCard}/>
        <div onClick={e => this.handleContentClick()}>
          <TopLine
            onClick={e => this.handleContentClick()}
            styles={this.styles}
            handleSearchChange={this.handleSearchChange.bind(this)}
            count={this.state.visibleCards.length}/>
          <div style={this.leftStyles()}>
            <Sidebar
              clearType={(e, type) => this.clearFilterType(type)}
              handleClick={this.handleFilterChange.bind(this)}
              show={this.Filters}
              filters={this.state.filters}/>
            </div>
          <div
            onClick={e => this.handleContentClick(e)}
            style={this.rightStyles()}>
            <Cards
              styles={this.styles}
              handleCardClick={(e, card) => this.handleCardClick(e, card)}
              cards={this.state.visibleCards}/>
          </div>
        </div>
      </StyleRoot>
    );
  }
}

export default radium(Layout);
