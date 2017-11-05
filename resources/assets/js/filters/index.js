import Filters from './filters';

export default class Filter {
  constructor() {
    this.Filters = new Filters();
    this.search = '';
    this.filterNames = [
      {
        multi: 'types',
        single: 'type',
      },
      {
        multi: 'rarities',
        single: 'rarity',
      },
      {
        multi: 'sets',
        single: 'set',
      },
      {
        multi: 'classes',
        single: 'class',
      },
    ];
  }

  showCard(card) {
    let r = true;
    if (card.name.toLowerCase()
        .indexOf(this.search) === -1) {
      return false;
    }
    this.filterNames.forEach(type => {
      let toShow = this.Filters.showCard(type.multi, card[type.single]);
      if (toShow === false || typeof toShow === 'undefined') {
        r = false;
      }
    });
    return r;
  }

  setSearch(search) {
    this.search = search.toLowerCase();
  }

  resetType(type) {
    return this.Filters.resetType(type);
  }

  toggleType(type, name) {
    return this.Filters.toggle(type, name);
  }

  setFilters(filters) {
    return this.Filters.setFilters(filters);
  }
}
