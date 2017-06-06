export default {
  newAttributes (attJson) {
    return new Attributes(attJson)
  }
}

const FILTER_TYPES = ['classes', 'rarities', 'sets', 'types']

var Attributes = (attJson) => {
  var tmp = {}

  tmp.attributes = {}
  tmp.selected = {
    classes: {},
    rarities: {},
    sets: {},
    types: {},
    'classes-count': 0,
    'rarities-count': 0,
    'sets-count': 0,
    'types-count': 0
  }

  tmp.canCardBePlayed = (card) => {
    if (!tmp.isFiltered('classes', card.class)) {
      return false
    } else if (!tmp.isFiltered('rarities', card.rarity)) {
      return false
    } else if (!tmp.isFiltered('sets', card.set)) {
      return false
    } else if (!tmp.isFiltered('types', card.type)) {
      return false
    }
    return true
  }

  tmp.getAtts = (type) => {
    return tmp.attributes[type]
  }

  tmp.isSelected = (type, val) => {
    if (!tmp.selected.hasOwnProperty(type) || !tmp.selected[type].hasOwnProperty(val)) {
      return false
    }
    return tmp.selected[type][val] === true
  }

  tmp.isFiltered = (type, val) => {
    return tmp.isSelected(type, val) || tmp.selected[type + '-count'] === 0
  }

  tmp.toggle = (type, val) => {
    if (tmp.selected[type][val] === true) {
      tmp.selected[type][val] = false
      tmp.selected[type + '-count']--
      return false
    }
    tmp.selected[type][val] = true
    tmp.selected[type + '-count']++

    if (tmp.selected[type + '-count'] >= tmp.attributes[type].length) {
      tmp.resetType(type)
    }

    return true
  }

  tmp.resetType = (type) => {
    for (var c in tmp.selected[type]) {
      if (tmp.selected[type].hasOwnProperty(c)) {
        tmp.selected[type][c] = false
      }
    }
    tmp.selected[type + '-count'] = 0
  }

  // Attributes setter/getter
  tmp.setAttributes = (attJson) => {
    tmp.attributes = attJson
    tmp.selected = {
      classes: {},
      rarities: {},
      sets: {},
      types: {},
      'classes-count': 0,
      'rarities-count': 0,
      'sets-count': 0,
      'types-count': 0
    }
    for (var i in FILTER_TYPES) {
      tmp.selected[FILTER_TYPES[i]] = {}
      var atts = tmp.attributes[FILTER_TYPES[i]]
      if (typeof atts === 'undefined') {
        continue
      }
      for (var j = 0; j < atts.length; j++) {
        tmp.selected[FILTER_TYPES[i]][atts[j].name] = false
      }
    }
  }

  tmp.getAttributes = () => {
    return tmp.attributes
  }

  tmp.getSelected = () => {
    return tmp.selected
  }

  tmp.setAttributes(attJson)

  return tmp
}
