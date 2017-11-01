import React from 'react';
import radium from 'radium';

import CardProp from './CardProp';

class Card extends React.Component {
  constructor() {
    super();
  }

  getStyles() {
    let styles = {
        'width': '100%',
    };
    if (this.props.styles) {
      Object.assign(styles, this.props.styles.getCard());
    }
    return styles;
  }

  getCardWrapper() {
    let styles = {};
    if (this.props.styles) {
      Object.assign(styles, this.props.styles.getCardWrapper());
    }
    return styles;
  }

  cardProps() {
    return [
      <CardProp key={'c'} name={'COST'} val={this.props.card.cost}/>,
      <CardProp key={'a'} name={'ATK'} val={this.props.card.atk}/>,
      <CardProp key={'h'} name={'HP'} val={this.props.card.hp}/>,
    ];
  }

  render() {
    return (
      <div
        style={this.getCardWrapper()}>
        <img
          style={{width: '100%'}}
          src={this.props.card.image_path}/>
      </div>
    );
  }
}

export default radium(Card);
