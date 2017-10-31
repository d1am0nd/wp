import React from 'react';
import radium from 'radium';

import Search from '../filters/Search';

class TopLine extends React.Component {
  constructor() {
    super();
  }

  handleSearchChange(e) {
    if (this.props.handleSearchChange) {
      this.props.handleSearchChange(e);
    }
  }

  getLayoutStyles() {
    let styles = {};
    if (this.props.styles) {
      Object.assign(styles, this.props.styles);
    }
    return styles;
  }

  getLeftStyles() {
    let styles = {
      width: '300px',
      float: 'left',
    };
    return styles;
  }

  getRightStyles() {
    let styles = {
      float: 'right',
      marginRight: '20px',
    };
    return styles;
  }

  render() {
    return (
      <div style={this.getLayoutStyles()}>
        <div
          style={this.getLeftStyles()}>
          <Search
            handleChange={e => this.handleSearchChange(e)}
            />
        </div>
        <div
          style={this.getRightStyles()}>
          {this.props.count} cards found
        </div>
        <div style={{clear: 'both'}}></div>
      </div>
    );
  }
}

export default radium(TopLine);
