import React from 'react';
import radium from 'radium';

import CardProp from './CardProp';

class Card extends React.Component {
  constructor() {
    super();
  }

  getCardWrapper() {
    let styles = {};
    if (this.props.styles) {
      Object.assign(styles, this.props.styles.getCardWrapper());
    }
    return styles;
  }

  handleClick(e) {
    if (this.props.handleClick) {
      this.props.handleClick(e);
    }
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
        onClick={e => this.handleClick(e)}
        style={this.getCardWrapper()}>
        <img
          alt={this.props.card.name}
          title={this.props.card.name}
          style={{width: '100%', cursor: 'pointer'}}
          src={this.props.card.image_path}/>
      </div>
    );
  }
}

export default radium(Card);
