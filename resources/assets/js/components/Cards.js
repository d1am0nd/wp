import React from 'react';
import radium from 'radium';

import Card from './card/Card';

class Cards extends React.Component {
  constructor() {
    super();
  }

  getStyles() {
    let styles = {};
    if (this.props.styles) {
      Object.assign(styles, this.props.styles.getCards());
    }
    return styles;
  }

  renderCards() {
    return this
      .props
      .cards
      .map(i => {
        return <Card
          styles={this.props.styles}
          key={i.id}
          card={i}/>;
      });
  }

  render() {
    return (
      <div
        style={this.getStyles()}>
        {this.renderCards()}
      </div>
    );
  }
}

export default radium(Cards);
