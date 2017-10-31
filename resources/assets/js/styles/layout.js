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

  // Boolean if open
  getLeft() {
    let styles = {
      height: '100%',
      position: 'fixed',
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

  // Boolean if open
  getRight() {
    let styles = {
      marginRight: '20px',
      transition: this.sbTransitionSpeed + 's',
    };
    let margin = 20;
    if (this.sidebarOpen === true) {
      styles.marginLeft = (this.sbWidth + margin) + 'px';
    } else {
      styles.marginLeft = margin + 'px';
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
