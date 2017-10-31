import React from 'react';
import radium from 'radium';

class Search extends React.Component {
  constructor() {
    super();
  }

  getPlaceholder() {
    if (this.props.placeholder) {
      return this.props.placeholder;
    }
    return 'Search...';
  }

  getStyles() {
    let styles = {
      width: '100%',
    };
    if (this.props.styles) {
      Object.assign(styles, this.props.styles);
    }
    return styles;
  }

  handleChange(e) {
    if (this.props.handleChange) {
      this.props.handleChange(e);
    }
  }

  render() {
    return (
      <input
        style={this.getStyles()}
        placeholder={this.getPlaceholder()}
        type="text"
        onChange={e => this.handleChange(e)} />
    );
  }
}

export default radium(Search);
