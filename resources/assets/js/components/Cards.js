import React from 'react';
import radium from 'radium';

import InfiniteScroll from 'react-infinite-scroller';

import Card from './card/Card';

class Cards extends React.Component {
  constructor() {
    super();
    this.show = 28;
  }

  getStyles() {
    let styles = {};
    if (this.props.styles) {
      Object.assign(styles, this.props.styles.getCards());
    }
    return styles;
  }

  hasMore() {
    return this.show < this.props.cards.length;
  }

  loadMore() {
    if (this.props.cards.length > 0) {
      this.show += 12;
      this.forceUpdate();
    }
  }

  handleCardClick(e, card) {
    if (this.props.handleCardClick) {
      this.props.handleCardClick(e, card);
    }
  }

  renderCards() {
    return this
      .props
      .cards
      .slice(0, this.show)
      .map(i => {
        return <Card
          handleClick={e => this.handleCardClick(e, i)}
          styles={this.props.styles}
          key={i.id}
          card={i}/>;
      });
  }

  render() {
    return (
      <div>
        <InfiniteScroll
          style={this.getStyles()}
          pageStart={0}
          initialLoad={false}
          loadMore={this.loadMore.bind(this)}
          hasMore={this.hasMore()}
          loader={<div className="loader">Loading ...</div>}>
          {this.renderCards()}
        </InfiniteScroll>
      </div>
    );
  }
}

export default radium(Cards);
