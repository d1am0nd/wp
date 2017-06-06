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

  tmp.getClasses = () => {
    return tmp.attributes.classes
  }

  tmp.toggleClass = (className) => {
    if (tmp.isClassSelected(className)) {
      tmp.removeClass(className)
    } else {
      tmp.addClass(className)
    }
  }

  tmp.addClass = (className) => {
    tmp.selected.classes.push(className)
  }

  tmp.removeClass = (className) => {
    var i = tmp.selected.classes.indexOf(className)
    if (i !== -1) {
      tmp.selected.classes.splice(i, 1)
    }
  }

  tmp.isClassSelected = (className) => {
    return tmp.selected.classes.indexOf(className) !== -1
  }

  tmp.isClassFiltered = (className) => {
    return tmp.selected.classes.length === 0 || tmp.selected.classes.indexOf(className) !== -1
  }

  tmp.getRarities = () => {
    return tmp.attributes.rarities
  }

  tmp.toggleRarity = (rarity) => {
    if (tmp.isRaritySelected(rarity)) {
      tmp.removeRarity(rarity)
    } else {
      tmp.addRarity(rarity)
    }
  }

  tmp.addRarity = (rarity) => {
    tmp.selected.rarities.push(rarity)
  }

  tmp.removeRarity = (rarity) => {
    var i = tmp.selected.rarities.indexOf(rarity)
    if (i !== -1) {
      tmp.selected.rarities.splice(i, 1)
    }
  }

  tmp.isRaritySelected = (rarity) => {
    return tmp.selected.rarities.indexOf(rarity) !== -1
  }

  tmp.isRarityFiltered = (rarity) => {
    return (tmp.selected.rarities.length === 0) || tmp.selected.rarities.indexOf(rarity) !== -1
  }

  tmp.getSets = () => {
    return tmp.attributes.sets
  }

  tmp.toggleSet = (set) => {
    if (tmp.isSetSelected(set)) {
      tmp.removeSet(set)
    } else {
      tmp.addSet(set)
    }
  }

  tmp.addSet = (set) => {
    tmp.selected.sets.push(set)
  }

  tmp.removeSet = (set) => {
    var i = tmp.selected.sets.indexOf(set)
    if (i !== -1) {
      tmp.selected.sets.splice(i, 1)
    }
  }

  tmp.isSetSelected = (set) => {
    return tmp.selected.sets.indexOf(set) !== -1
  }

  tmp.isSetFiltered = (set) => {
    return (tmp.selected.sets.length === 0) || tmp.selected.sets.indexOf(set) !== -1
  }

  tmp.getTypes = () => {
    return tmp.attributes.types
  }

  tmp.toggleType = (type) => {
    if (tmp.isTypeSelected(type)) {
      tmp.removeType(type)
    } else {
      tmp.addType(type)
    }
  }

  tmp.addType = (type) => {
    tmp.selected.types.push(type)
  }

  tmp.removeType = (type) => {
    var i = tmp.selected.types.indexOf(type)
    if (i !== -1) {
      tmp.selected.types.splice(i, 1)
    }
  }

  tmp.isTypeSelected = (type) => {
    return tmp.selected.types.indexOf(type) !== -1
  }

  tmp.isTypeFiltered = (type) => {
    return (tmp.selected.types.length === 0) || tmp.selected.types.indexOf(type) !== -1
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
