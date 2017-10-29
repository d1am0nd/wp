import React from 'react';
import radium from 'radium';

import Row from './filters/Row';

class Sidebar extends React.Component {
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
            showName={'types'}
            show={this.props.show}
            handleClick={(e, val) => this.handleClick(e, 'types', val)}
            filters={this.props.filters.types}/>
          <Row
            name={'Rarity'}
            showName={'rarities'}
            show={this.props.show}
            handleClick={(e, val) => this.handleClick(e, 'rarities', val)}
            filters={this.props.filters.rarities}/>
          <Row
            name={'Set'}
            showName={'sets'}
            show={this.props.show}
            handleClick={(e, val) => this.handleClick(e, 'sets', val)}
            filters={this.props.filters.sets}/>
          <Row
            name={'Class'}
            showName={'classes'}
            show={this.props.show}
            handleClick={(e, val) => this.handleClick(e, 'classes', val)}
            filters={this.props.filters.classes}/>
        </div>
      </div>
    );
  }
}

export default radium(Sidebar);
