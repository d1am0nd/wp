export default class Filters {
  constructor() {
    this.count = {
      types: 0,
      rarities: 0,
      sets: 0,
      classes: 0,
    };
    this.show = {
      types: {},
      rarities: {},
      sets: {},
      classes: {},
    };
  }

  setFilters(filters) {
    for (let prop in this.show) {
      if (this.show.hasOwnProperty(prop)) {
        filters[prop].forEach(i => {
          this.show[prop][i.name] = false;
        });
      }
    }
    this.filters = filters;
  }

  resetType(type) {
    for (let prop in this.show[type]) {
      if (this.show[type].hasOwnProperty(prop)) {
        this.show[type][prop] = false;
      }
    }
    this.count[type] = 0;
  }

  showFilter(type, val) {
    return this.show[type][val] === true;
  }

  showCard(type, val) {
    return this.count[type] === 0 ||
      this.show[type][val] === true;
  }

  toggle(type, val) {
    if (this.count[type] === 0) {
      console.log('we in ');
      this.resetType(type);
    }
    if (this.show[type][val] === true) {
      this.count[type]--;
      this.show[type][val] = false;
    } else {
      this.count[type]++;
      this.show[type][val] = true;
    }
    console.log('type', this.count[type]);
  }
}
