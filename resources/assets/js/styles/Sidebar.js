export default class Sidebar {
  constructor() {

  }

  getSidebarWrapper() {
    return {
      position: 'relative',
      display: 'block',
      height: '100%',
      boxShadow: '0 0 20px 0 rgba(0,0,0,0.16)',
      borderRight: '3px solid rgb(200, 200, 200, 1)',
    };
  }

  topRowStyles() {
    return {
      paddingTop: '20px',
      width: '100%',
    };
  }
}
