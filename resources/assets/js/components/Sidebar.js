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
        borderRight: '3px solid rgb(200, 200, 200, 1)',
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
      paddingTop: '20px',
      width: '100%',
    };
  }

  clearType(e, type) {
    if (this.props.clearType) {
      this.props.clearType(e, type);
    }
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
          name={'Types'}
          showName={'types'}
          show={this.props.show}
          clearType={e => this.clearType(e, 'types')}
          handleClick={(e, val) => this.handleClick(e, 'types', val)}
          filters={this.props.filters.types}/>
        <Row
          name={'Rarities'}
          showName={'rarities'}
          show={this.props.show}
          clearType={e => this.clearType(e, 'rarities')}
          handleClick={(e, val) => this.handleClick(e, 'rarities', val)}
          filters={this.props.filters.rarities}/>
        <Row
          name={'Sets'}
          showName={'sets'}
          show={this.props.show}
          clearType={e => this.clearType(e, 'sets')}
          handleClick={(e, val) => this.handleClick(e, 'sets', val)}
          filters={this.props.filters.sets}/>
        <Row
          name={'Classes'}
          showName={'classes'}
          show={this.props.show}
          clearType={e => this.clearType(e, 'classes')}
          handleClick={(e, val) => this.handleClick(e, 'classes', val)}
          filters={this.props.filters.classes}/>
      </div>
    );
  }
}

export default radium(Sidebar);
