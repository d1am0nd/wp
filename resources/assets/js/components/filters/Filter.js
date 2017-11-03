import React from 'react';
import radium from 'radium';

import styleVars from '../../styles/vars';

class Filter extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {
        'display': 'inline-block',
        'width': '46%',
        'marginLeft': '2%',
        'marginRight': '2%',
        ':hover': {
          cursor: 'pointer',
        },
      },
    };
  }

  getStyles() {
    let s = {};
    Object.assign(s, this.styles.base);
    return s;
  }

  getButtonStyles() {
    let s = {
      'backgroundColor': 'white',
      'border': '2px solid #515151',
      'padding': '12px 30px !important',
      'fontSize': '20px',
      'width': '100%',
      ...styleVars.fonts.main,
      ':hover': {
        cursor: 'pointer',
      },
      ':visited': {
        backgroundColor: 'white',
      },
      ':active': {
        outline: 'none',
      },
    };
    if (this.isActive()) {
      let active = {
        'border': '1px solid black',
        'backgroundColor': 'black',
        'color': 'white',
      };
      Object.assign(s, active);
    }
    return s;
  }

  handleClick(e) {
    this.active = !this.active;
    this.forceUpdate();
    this.props.handleClick(e, this.props.filter.name);
  }

  isActive() {
    return this.props.active;
  }

  render() {
    return (
      <li
        onClick={this.handleClick.bind(this)}
        style={this.getStyles()}>
        <button
          key={this.props.name + '-filter-button'}
          style={this.getButtonStyles()}>
          {this.props.filter.name}
        </button>
      </li>
    );
  }
}

export default radium(Filter);
