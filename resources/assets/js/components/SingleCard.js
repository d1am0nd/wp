import React from 'react';
import radium from 'radium';

class SingleCard extends React.Component {
  constructor() {
    super();
  }

  getStyles() {
    let styles = {
      position: 'fixed',
      zIndex: 10,
      width: '100%',
      display: 'none',
    };
    if (this.props.card) {
      styles.display = 'block';
    }
    return styles;
  }

  getRelativeStyles() {
    let styles = {
      position: 'relative',
      display: 'flex',
      marginLeft: 'auto',
      marginRight: 'auto',
      width: '620px',
      backgroundColor: 'rgba(0, 0, 0, 0.5)',
    };
    return styles;
  }

  getLeftStyles() {
    let styles = {
      width: '48%',
      display: 'inline-block',
    };
    return styles;
  }

  getRightStyles() {
    let styles = {
      width: '48%',
      color: 'white',
      marginTop: '45px',
      display: 'inline-block',
    };
    return styles;
  }

  render() {
    return (
      <div style={this.getStyles()}>
        <div style={this.getRelativeStyles()}>
          <div style={this.getLeftStyles()}>
            <img
              src="http://media.services.zam.com/v1/media/byName/hs/cards/enus/pal/GVG_093.png"/>
          </div>
          <div style={this.getRightStyles()}>
          some text
          </div>
        </div>
      </div>
    );
  }
}

export default radium(SingleCard);
