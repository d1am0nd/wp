import React from 'react';
import radium from 'radium';

import InfiniteScroll from 'react-infinite-scroller';

import Card from './card/Card';

class Cards extends React.Component {
  constructor() {
    super();
    this.show = 12;
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

  renderCards() {
    return this
      .props
      .cards
      .slice(0, this.show)
      .map(i => {
        return <Card
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
