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
      Object.assign(styles, this.props.styles.getTopLineStyle());
    }
    return styles;
  }

  getLeftStyles() {
    let styles = {
      width: '100%',
    };
    return styles;
  }

  /*
  getRightStyles() {
    let styles = {
      float: 'right',
      marginRight: '20px',
    };
    return styles;
  }
  */

  getSearchStyles() {
    let styles = {};
    Object.assign(styles, this.props.styles.getSearch());
    return styles;
  }

  render() {
    return (
      <div style={this.getLayoutStyles()}>
        <div
          style={this.getLeftStyles()}>
          <Search
            styles={this.getSearchStyles()}
            handleChange={e => this.handleSearchChange(e)}
            />
        </div>
      </div>
    );
  }
}

export default radium(TopLine);
