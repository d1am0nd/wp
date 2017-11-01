import React from 'react';
import radium from 'radium';

import Filter from './Filter';

class Row extends React.Component {
  constructor() {
    super();
    this.styles = {
      base: {
        marginLeft: '10px',
        marginRight: '10px',
        fontSize: '35px',
      },
    };
  }

  getLeftStyles() {
    let styles = {
      float: 'left',
    };
    return styles;
  }

  getRightStyles() {
    let styles = {
      float: 'right',
      cursor: 'pointer',
      borderBottom: '1px solid black',
    };
    return styles;
  }

  clearType(e) {
    if (this.props.clearType) {
      this.props.clearType(e);
    }
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
          <div style={this.getLeftStyles()}>
            {this.props.name}
          </div>
          <div
            onClick={e => this.clearType(e)}
            style={this.getRightStyles()}>
            Clear
          </div>
          <div style={{clear: 'both'}}></div>
        </div>
        <ul style={{padding: '0'}}>
          {this.filters()}
        </ul>
      </div>
    );
  }
}

export default radium(Row);
