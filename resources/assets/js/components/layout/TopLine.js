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

  render() {
    return (
      <div>
        <Search
          handleChange={e => this.handleSearchChange(e)}
          />
        Top line. {this.props.count} found
      </div>
    );
  }
}

export default radium(TopLine);
