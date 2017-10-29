import React from 'react';
import radium from 'radium';

class Filter extends React.Component {
  constructor() {
    super();
    this.active = true;
    this.styles = {
      base: {
        'display': 'inline-block',
        'marginRight': '5px',
        ':hover': {
          cursor: 'pointer',
        },
      },
      active: {
        border: 'solid black 1px',
      },
    };
  }

  getStyles() {
    let s = {};
    Object.assign(s, this.styles.base);
    if (this.isActive()) {
      Object.assign(s, this.styles.active);
    }
    return s;
  }

  handleClick(e) {
    this.active = !this.active;
    this.forceUpdate();
    this.props.handleClick(e, this.props.filter.name);
  }

  isActive() {
    return this.active;
  }

  render() {
    return (
      <li
        onClick={this.handleClick.bind(this)}
        style={this.getStyles()}>
        <button>
          {this.props.filter.name}
        </button>
      </li>
    );
  }
}

export default radium(Filter);
