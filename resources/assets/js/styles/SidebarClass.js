export default class SidebarClass {
  constructor(sidebarOpen) {
    this.sidebarOpen = sidebarOpen;
  }

  setSidebar(open) {
    this.sidebarOpen = open;
  }

  toggleSidebar() {
    this.sidebarOpen = !this.sidebarOpen;
  }
}
