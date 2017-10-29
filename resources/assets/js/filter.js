class Filters {
  constructor() {
    this.names: [
      'types',
      'rarities',
      'sets',
      'classes',
    ];
    this.filters: {
      rarities: [],
      mechanics: [],
      playReqs: [],
      sets: [],
      types: [],
      classes: [],
    }
    this.count: {
      types: 0,
      rarities: 0,
      sets: 0,
      classes: 0,
    };
    this.show: {
      types: {},
      rarities: {},
      sets: {},
      classes: {},
    };
  }

  setFilters(filters) {
    filters.forEach(i => {
      this.show[i.name] = true;
      console.log('i', i);
    });
    this.filters = filters;
  }

  show(type, val) {
    return this.show[type][val] === true;
  }

  toggle(type, val) {
    if (this.show[type][val] === true) {
      this.count[type]--;
      this.show[type][val] = false;
    } else {
      this.count[type]++;
      this.show[type][val] = true;
    }
  }
}
