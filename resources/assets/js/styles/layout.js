export default class styles {
  constructor() {
    this.sbWidth = 400;
    this.sbTransitionSpeed = 0.3;
  }

  // Boolean if open
  getLeft(open) {
    let styles = {
      height: '100%',
      position: 'fixed',
      width: this.sbWidth + 'px',
      transition: this.sbTransitionSpeed + 's',
    };
    if (open === true) {
      styles.left = '0px';
    } else {
      styles.left = (this.sbWidth * -1) + 'px';
    }
    return styles;
  }

  // Boolean if open
  getRight(open) {
    let styles = {
      marginRight: '20px',
      transition: '0.4s',
    };
    let margin = 20;
    if (open === true) {
      styles.marginLeft = (this.sbWidth + margin) + 'px';
    } else {
      styles.marginLeft = margin + 'px';
    }
    return styles;
  }

  getToggleIcon(open) {
    let margins = 50;
    let w = 70;
    let h = w;
    let styles = {
      position: 'fixed',
      left: margins + 'px',
      bottom: margins + 'px',
      height: h + 'px',
      width: w + 'px',
      cursor: 'pointer',
      background: 'black',
      transition: this.sbTransitionSpeed + 's',
    };
    if (open) {
      styles.display = 'none';
    } else {
      styles.display = 'block';
    }
    return styles;
  }
}
