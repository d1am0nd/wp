import React from 'react';
import radium from 'radium';

import Row from './filters/Row';

class Filters extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {
        position: 'absolute',
        display: 'block',
        left: 0,
        width: '25%',
        height: '100%',
      },
      inner: {
        position: 'relative',
        width: '100%',
      },
    };
  }

  getStyles() {
    return this.styles.base;
  }

  handleClick(e, type, id) {
    return this.props.handleClick(type, id);
  }

  render() {
    return (
      <div style={this.getStyles()}>
        <div style={this.styles.inner}>
          <Row
            name={'Type'}
            show={this.props.show.types}
            handleClick={(e, val) => this.handleClick(e, 'types', val)}
            filters={this.props.filters.types}/>
          <Row
            name={'Rarity'}
            show={this.props.show.rarities}
            handleClick={(e, val) => this.handleClick(e, 'rarities', val)}
            filters={this.props.filters.rarities}/>
          <Row
            name={'Set'}
            show={this.props.show.sets}
            handleClick={(e, val) => this.handleClick(e, 'sets', val)}
            filters={this.props.filters.sets}/>
          <Row
            name={'Class'}
            show={this.props.show.classes}
            handleClick={(e, val) => this.handleClick(e, 'classes', val)}
            filters={this.props.filters.classes}/>
        </div>
      </div>
    );
  }
}

export default radium(Filters);
