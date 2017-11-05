import SidebarClass from './SidebarClass';

import vars from './vars';

export default class TopLine extends SidebarClass {
  constructor(sidebarOpen) {
    super(sidebarOpen);
  }

  getTopLineStyles() {
    let padding = '15px';
    let margin = 20;
    let styles = {
      borderBottom: 'solid 1spx #DCDCDC',
      marginBottom: '20px',
      paddingRight: margin + 'px',
      paddingTop: padding,
      paddingBottom: padding,
      boxShadow: '0 0 20px 0 rgba(0,0,0,0.16)',
      transition: vars.nums.sbTransitionSpeed + 's',
    };
    if (this.sidebarOpen === true) {
      styles.paddingLeft = (vars.nums.sbWidth + margin) + 'px';
    } else {
      styles.paddingLeft = margin;
    }
    return styles;
  }

  getSearchStyles() {
    return {
      'width': '100%',
      'borderLeft': 0,
      'borderRight': 0,
      'borderTop': 0,
      'borderBottom': '1px solid #DCDCDC',
      'fontSize': '50px',
      ...vars.fonts.main,
      ':focus': {
        'borderLeft': 0,
        'borderRight': 0,
        'borderTop': 0,
        'outline': 'none',
        'borderBottom': '1px solid black',
      },
    };
  }
}
