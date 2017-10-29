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

  filterActive(filter) {
    return this.props.show.showFilter(this.props.showName, filter.name);
  }

  filters() {
    return this
      .props
      .filters
      .map(i => {
        return <Filter
          key={i.id}
          active={this.filterActive(i)}
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
