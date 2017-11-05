import React from 'react';
import radium from 'radium';

import Filters from '../filters/index';

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

    this.Filters = new Filters();

    // Fetch cards
    cardsApi
      .getCards()
      .then(res => {
        // Check if the url is /card/{cardName}
        // Show that card if it is (set it as selectedCard)
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

        // set state after loading cards
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
        return this.Filters.showCard(i);
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
      window.history.pushState('', '', '/card/' + card.slug);
      this.setState({
        selectedCard: card,
      });
    }
  }

  handleContentClick(e) {
    if (this.state.selectedCard) {
      window.history.pushState('', '', '/');
      this.setState({
        selectedCard: null,
      });
    }
  }

  handleSearchChange(e) {
    this.Filters.setSearch(e.target.value);
    this.setState({
      search: e.target.value,
      visibleCards: this.visibleCards(this.state.cards),
    });
  }

  handleFilterChange(type, name) {
    this.Filters.toggleType(type, name);
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
              show={this.Filters.Filters}
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
