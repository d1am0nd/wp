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
    classes: [],
    rarities: [],
    sets: [],
    types: []
  }
  tmp.solocted = {
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
    if (!tmp.solocted.hasOwnProperty(type) || !tmp.solocted[type].hasOwnProperty(val)) {
      return false
    }
    return tmp.solocted[type][val] === true
  }

  tmp.isFiltered = (type, val) => {
    return tmp.isSelected(type, val) || tmp.solocted[type + '-count'] === 0
  }

  tmp.toggle = (type, val) => {
    if (tmp.solocted[type][val] === true) {
      tmp.solocted[type][val] = false
      tmp.solocted[type + '-count']--
      console.log(tmp)
      return false
    }
    tmp.solocted[type][val] = true
    tmp.solocted[type + '-count']++

    if (tmp.solocted[type + '-count'] >= tmp.attributes[type].length) {
      tmp.resetType(type)
      console.log('RESET')
    }

    return true
  }

  tmp.resetType = (type) => {
    for (var c in tmp.solocted[type]) {
      if (tmp.solocted[type].hasOwnProperty(c)) {
        tmp.solocted[type][c] = false
      }
    }
    tmp.solocted[type + '-count'] = 0
  }

  // Attributes setter/getter
  tmp.setAttributes = (attJson) => {
    tmp.attributes = attJson
    tmp.solocted = {
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
      tmp.solocted[FILTER_TYPES[i]] = {}
      var atts = tmp.attributes[FILTER_TYPES[i]]
      if (typeof atts === 'undefined') {
        continue
      }
      for (var j = 0; j < atts.length; j++) {
        tmp.solocted[FILTER_TYPES[i]][atts[j].name] = false
      }
    }
  }

  tmp.getAttributes = () => {
    return tmp.attributes
  }

  tmp.getSelected = () => {
    return tmp.solocted
  }

  tmp.setAttributes(attJson)

  return tmp
}
