import React from 'react';
import radium from 'radium';

import Row from './filters/Row';

class Sidebar extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {
        position: 'relative',
        display: 'block',
        height: '100%',
        boxShadow: '0 0 20px 0 rgba(0,0,0,0.16)',
        borderRight: '3px solid #DCDCDC',
      },
    };
  }

  getStyles() {
    return this.styles.base;
  }

  xStyle() {
    return {
      ':hover': {
        cursor: 'pointer',
      },
    };
  }

  topRowStyles() {
    return {
      width: '100%',
    };
  }

  handleClick(e, type, id) {
    return this.props.handleClick(type, id);
  }

  render() {
    return (
      <div style={this.getStyles()}>
        <div style={this.topRowStyles()}>
        </div>
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
    );
  }
}

export default radium(Sidebar);
