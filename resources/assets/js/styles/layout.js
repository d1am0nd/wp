import SidebarClass from './SidebarClass';

import vars from './vars';

export default class Layout extends SidebarClass {
  constructor(sidebarOpen) {
    super(sidebarOpen);
  }

  getLeft() {
    let styles = {
      'height': '100%',
      'overflowY': 'auto',
      'position': 'fixed',
      'boxShadow': '0 0 20px 10px rgba(0,0,0,0.16)',
      'top': 0,
      'background': 'white', // '#EDEDED',
      'zIndex': 3,
      'width': vars.nums.sbWidth + '%',
      'transition': vars.nums.sbTransitionSpeed + 's',
      '@media (max-width: 750px)': {
        width: vars.nums.sbMWidth + '%',
      },
    };
    if (this.sidebarOpen === true) {
      styles.left = '0px';
      styles['@media (max-width: 750px)']
        .left = '0%';
    } else {
      styles.left = (vars.nums.sbWidth * -1) + '%';
      styles['@media (max-width: 750px)']
        .left = (vars.nums.sbMWidth * -1) + '%';
    }
    return styles;
  }

  getRight() {
    let styles = {
      'paddingRight': '20px',
      'transition': vars.nums.sbTransitionSpeed + 's',
      '@media (max-width: 750px)': {},
    };
    let margin = 2;
    if (this.sidebarOpen === true) {
      styles.paddingLeft = (vars.nums.sbWidth + margin) + '%';
      styles['@media (max-width: 750px)']
        .paddingLeft = (vars.nums.sbMWidth + margin) + '%';
    } else {
      styles.paddingLeft = margin + '%';
      styles['@media (max-width: 750px)']
        .paddingLeft = margin + '%';
    }
    return styles;
  }

  getToggleIcon() {
    let margins = 50;
    let w = 100;
    let h = w;
    let styles = {
      position: 'fixed',
      right: margins + 'px',
      bottom: margins + 'px',
      height: h + 'px',
      width: w + 'px',
      fontSize: w + 'px',
      cursor: 'pointer',
      // background: 'black',
      transition: vars.nums.sbTransitionSpeed + 's',
      zIndex: 5,
    };
    if (this.sidebarOpen === true) {
      styles.transform = 'rotateY(-180deg)';
    }
    return styles;
  }
}
