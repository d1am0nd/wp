import React from 'react';
import radium from 'radium';

class CardProp extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {
        'display': 'inline',
      },
    };
  }

  getStyles() {
    return this.styles.base;
  }

  render() {
    return (
      <li
        style={this.getStyles()}>
        {this.props.name}: {this.props.val}
      </li>
    );
  }
}

export default radium(CardProp);
