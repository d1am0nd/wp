import SidebarClass from './SidebarClass';

import vars from './vars';

export default class Layout extends SidebarClass {
  constructor(sidebarOpen) {
    super(sidebarOpen);
  }

  getLeft() {
    let styles = {
      height: '100%',
      overflowY: 'auto',
      position: 'fixed',
      boxShadow: '0 0 20px 10px rgba(0,0,0,0.16)',
      top: 0,
      background: 'white', // '#EDEDED',
      zIndex: 3,
      width: vars.nums.sbWidth + 'px',
      transition: vars.nums.sbTransitionSpeed + 's',
    };
    if (this.sidebarOpen === true) {
      styles.left = '0px';
    } else {
      styles.left = (vars.nums.sbWidth * -1) + 'px';
    }
    return styles;
  }

  getRight() {
    let styles = {
      paddingRight: '20px',
      transition: vars.nums.sbTransitionSpeed + 's',
    };
    let margin = 20;
    if (this.sidebarOpen === true) {
      styles.paddingLeft = (vars.nums.sbWidth + margin) + 'px';
    } else {
      styles.paddingLeft = margin + 'px';
    }
    return styles;
  }

  getToggleIcon() {
    let margins = 50;
    let w = 70;
    let h = w;
    let styles = {
      position: 'fixed',
      left: margins + 'px',
      bottom: margins + 'px',
      height: h + 'px',
      width: w + 'px',
      fontSize: w + 'px',
      cursor: 'pointer',
      // background: 'black',
      transition: vars.nums.sbTransitionSpeed + 's',
      zIndex: '5',
    };
    if (this.sidebarOpen === true) {
      styles.transform = 'rotateY(-180deg)';
    }
    return styles;
  }
}
