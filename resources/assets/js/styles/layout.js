export default class styles {
  constructor(sidebarOpen) {
    this.sbWidth = 400;
    this.sbTransitionSpeed = 0.3;

    this.sidebarOpen = sidebarOpen;
    this.dragging = {
      isDragging: false,
      left: 0,
    };
  }

  setSidebar(open) {
    this.sidebarOpen = open;
  }

  toggleSidebar() {
    this.sidebarOpen = !this.sidebarOpen;
  }

  setDragging(dragging) {
    this.dragging = dragging;
  }

  getTopLineStyle() {
    let padding = '15px';
    let styles = {
      borderBottom: 'solid 1spx #DCDCDC',
      marginBottom: '20px',
      paddingTop: padding,
      paddingBottom: padding,
      boxShadow: '0 0 20px 0 rgba(0,0,0,0.16)',
      transition: this.sbTransitionSpeed + 's',
    };
    let margin = 20;
    if (this.sidebarOpen === true) {
      styles.paddingLeft = (this.sbWidth + margin) + 'px';
    } else {
      styles.paddingLeft = margin;
    }
    return styles;
  }

  getLeft() {
    let styles = {
      height: '100%',
      position: 'fixed',
      top: 0,
      background: '#EDEDED',
      zIndex: 3,
      width: this.sbWidth + 'px',
      transition: this.sbTransitionSpeed + 's',
    };
    if (this.sidebarOpen === true) {
      styles.left = '0px';
    } else {
      styles.left = (this.sbWidth * -1) + 'px';
    }
    return styles;
  }

  getRight() {
    let styles = {
      paddingRight: '20px',
      transition: this.sbTransitionSpeed + 's',
    };
    let margin = 20;
    if (this.sidebarOpen === true) {
      styles.paddingLeft = (this.sbWidth + margin) + 'px';
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
      transition: this.sbTransitionSpeed + 's',
      zIndex: '5',
    };
    if (this.sidebarOpen === true) {
      styles.transform = 'rotateY(-180deg)';
    }
    return styles;
  }
}
