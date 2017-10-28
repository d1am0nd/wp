import React from 'react';
import radium from 'radium';

import Filter from './Filter';

class Row extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {

      },
    };
  }

  filters() {
    return this
      .props
      .filters
      .map(i => {
        return <Filter
          key={i.id}
          filter={i}
          handleClick={this.props.handleClick.bind(this)}/>;
      });
  }

  render() {
    return (
      <div
        style={this.styles.base}>
        <div>
          {this.props.name}
          <ul>
            {this.filters()}
          </ul>
        </div>
      </div>
    );
  }
}

export default radium(Row);
