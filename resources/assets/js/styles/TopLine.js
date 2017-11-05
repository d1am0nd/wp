import SidebarClass from './SidebarClass';

import vars from './vars';

export default class TopLine extends SidebarClass {
  constructor(sidebarOpen) {
    super(sidebarOpen);
  }

  getTopLineStyles() {
    let padding = '15px';
    let margin = 2;
    let styles = {
      'borderBottom': 'solid 1spx #DCDCDC',
      'marginBottom': '20px',
      'paddingRight': 20 + 'px',
      'paddingTop': padding,
      'paddingBottom': padding,
      'boxShadow': '0 0 20px 0 rgba(0,0,0,0.16)',
      'transition': vars.nums.sbTransitionSpeed + 's',
      '@media (max-width: 750px)': {},
    };
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
