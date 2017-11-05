import LayoutStyle from './Layout';
import TopLine from './TopLine';
import Cards from './Cards';
import Sidebar from './Sidebar';

export default class Styles {
  constructor() {
    this.Layout = new LayoutStyle(true);
    this.TopLine = new TopLine(true);
    this.Cards = new Cards(true);
    this.Sidebar = new Sidebar();
  }

  setSidebar(isOpen) {
    this.Layout.setSidebar(isOpen);
    this.TopLine.setSidebar(isOpen);
    this.Cards.setSidebar(isOpen);
  }
}
