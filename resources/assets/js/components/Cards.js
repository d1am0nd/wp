import React from 'react';
import radium from 'radium';

import Card from './card/Card';

class Cards extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {
        'width': '100%',
        'display': 'flex',
        'flexWrap': 'wrap',
      },
    };
  }

  getStyles() {
    return this.styles.base;
  }

  renderCards() {
    return this
      .props
      .cards
      .map(i => {
        console.log(i);
        return <Card
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
