import React from 'react';
import radium from 'radium';

import CardProp from './CardProp';

class Card extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {
        'width': '33%',
        'flexGrow': '1',
      },
      wrapper: {
        display: 'flex',
      },
      left: {
        'width': '50%',
      },
      right: {
        'width': '50%',
      },
    };
  }

  getStyles() {
    return this.styles.base;
  }

  getWrapperStyles() {
    return this.styles.wrapper;
  }

  getLeftStyles() {
    return this.styles.left;
  }

  getRightStyles() {
    return this.styles.right;
  }

  cardProps() {
    return [
      <CardProp name={'COST'} val={this.props.card.cost}/>,
      <CardProp name={'ATK'} val={this.props.card.atk}/>,
      <CardProp name={'HP'} val={this.props.card.hp}/>,
    ];
  }

  render() {
    return (
      <div
        style={this.getStyles()}>
        <div>{this.props.card.name}</div>
          <div
            style={this.getWrapperStyles()}>
          <div
            style={this.getLeftStyles()}>
            <img
              src={this.props.card.image_path}/>
          </div>
          <div
            style={this.getRightStyles()}>
            <div dangerouslySetInnerHTML={{__html: this.props.card.text}}></div>
          </div>
        </div>
        {this.cardProps()}
      </div>
    );
  }
}

export default radium(Card);
