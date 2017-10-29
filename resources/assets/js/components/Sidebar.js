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
            handleClick={(e, val) => this.handleClick(e, 'types', val)}
            filters={this.props.filters.types}/>
          <Row
            name={'Rarity'}
            handleClick={(e, val) => this.handleClick(e, 'rarities', val)}
            filters={this.props.filters.rarities}/>
          <Row
            name={'Set'}
            handleClick={(e, val) => this.handleClick(e, 'sets', val)}
            filters={this.props.filters.sets}/>
          <Row
            name={'Class'}
            handleClick={(e, val) => this.handleClick(e, 'classes', val)}
            filters={this.props.filters.classes}/>
        </div>
      </div>
    );
  }
}

export default radium(Filters);
