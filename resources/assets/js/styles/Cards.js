import SidebarClass from './SidebarClass';

export default class Cards extends SidebarClass {
  constructor(isOpen) {
    super(isOpen);
  }

  getCards() {
    return {
      'width': '100%',
      'display': 'flex',
      'flexWrap': 'wrap',
    };
  }

  getCardWrapper() {
    let styles = {
      'width': '25%',
      'flexGrow': '1',
      ':hover': {
        cursor: 'pointer',
      },
      '@media (max-width: 750px)': {
        width: '50%',
      },
    };
    if (this.sidebarOpen) {
      styles['@media (max-width: 750px)']
        .width = '100%';
    }
    return styles;
  }
}
