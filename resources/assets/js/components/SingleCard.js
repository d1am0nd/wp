import React from 'react';
import radium from 'radium';

class SingleCard extends React.Component {
  constructor() {
    super();
  }

  getRelativeStyles() {
    let styles = {
      zIndex: 10,
      borderRadius: '10px',
      position: 'fixed',
      display: 'flex',
      left: '20%',
      right: '20%',
      width: '60%',
      top: '10%',
      bottom: '10%',
      height: '80%',
      // marginLeft: '-320px',
      // width: '620px',
      transition: '2s',
      backgroundColor: 'rgba(0, 0, 0, 0.70)',
    };
    return styles;
  }

  getImageStyle() {
    let styles = {
      display: 'block',
      width: '100%',
      maxHeight: '100%',
    };
    return styles;
  }

  getTextStyles() {
    let styles = {
      fontSize: '40px',
    };
    return styles;
  }

  getFlavorStyles() {
    let styles = {
      fontSize: '35px',
      fontStyle: 'italic',
      marginTop: '20px',
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
      overflowY: 'auto',
    };
    return styles;
  }

  getLinkStyles() {
    let styles = {
      color: 'white',
    };
    return styles;
  }

  getUlStyles() {
    let styles = {
      listStyle: 'none',
      padding: 0,
      display: 'inline-block',
      width: '50%',
    };
    return styles;
  }

  getLeftUlStyles() {
    let styles = {
      // 'float': 'left',
    };
    Object.assign(styles, this.getUlStyles());
    return styles;
  }

  getRightUlStyles() {
    let styles = {
      // 'float': 'right',
    };
    Object.assign(styles, this.getUlStyles());
    return styles;
  }

  getLiStyles() {
    let styles = {
      fontSize: '30px',
    };
    return styles;
  }

  renderCost() {
    if (this.props.card.cost === null) {
      return;
    }
    return (
      <li style={this.getLiStyles()}>
        Cost: {this.props.card.cost}
      </li>
    );
  }

  renderAttack() {
    if (this.props.card.type !== 'MINION' &&
      this.props.card.type !== 'WEAPON') {
      return;
    }
    return (
      <li style={this.getLiStyles()}>
        Attack: {this.props.card.atk}
      </li>
    );
  }

  renderHp() {
    if (this.props.card.type !== 'MINION') {
      return;
    }
    return (
      <li style={this.getLiStyles()}>
        Hp: {this.props.card.hp}
      </li>
    );
  }

  renderWikia() {
    return (
      <li style={this.getLiStyles()}>
        <a
          target="_blank"
          style={this.getLinkStyles()}
          href={this.props.card.wikia_url}>
        Wikia
        </a>
      </li>
    );
  }

  renderGamepedia() {
    return (
      <li style={this.getLiStyles()}>
        <a
          target="_blank"
          style={this.getLinkStyles()}
          href={this.props.card.gamepedia_url}>
        Gamepedia
        </a>
      </li>
    );
  }

  renderHearthhead() {
    return (
      <li style={this.getLiStyles()}>
        <a
          target="_blank"
          style={this.getLinkStyles()}
          href={this.props.card.hearthhead_url}>
        HearthHead
        </a>
      </li>
    );
  }

  renderCard() {
    if (!this.props.card) {
      return;
    }
    return (
      <div style={this.getRelativeStyles()}>
        <div style={this.getLeftStyles()}>
          <img
            style={this.getImageStyle()}
            src={this.props.card.image_path}/>
        </div>
        <div style={this.getRightStyles()}>
          <h1>{this.props.card.name}</h1>
          <ul style={this.getLeftUlStyles()}>
            {this.renderWikia()}
            {this.renderGamepedia()}
            {this.renderHearthhead()}
          </ul>
          <ul style={this.getRightUlStyles()}>
            {this.renderCost()}
            {this.renderHp()}
            {this.renderAttack()}
          </ul>
          <div style={{clear: 'both'}}></div>
          <div
            style={this.getTextStyles()}
            dangerouslySetInnerHTML={{__html: this.props.card.text}}>
          </div>
          <div
            style={this.getFlavorStyles()}
            dangerouslySetInnerHTML={{__html: this.props.card.flavor}}>
          </div>
        </div>
      </div>
    );
  }

  render() {
    return (
      <div>
        {this.renderCard()}
      </div>
    );
  }
}

export default radium(SingleCard);
