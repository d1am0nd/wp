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
    'types-count': 0,
    cost: {},
    text: {
      name: '',
      text: ''
    }
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
    } else if (!tmp.isCostFiltered(card.cost)) {
      return false
    } else if (!tmp.isTextFiltered('name', card.name)) {
      return false
    } else if (!tmp.isTextFiltered('text', card.text)) {
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

  tmp.isTextFiltered = (type, val) => {
    var txt = tmp.selected.text[type]
    if (txt.length === 0) {
      return true
    }
    return val.indexOf(txt) !== -1
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

  tmp.setTrueArr = (type, vals) => {
    for (var i in tmp.attributes[type]) {
      if (vals.indexOf(tmp.attributes[type][i].name) === -1) {
        tmp.setFalse(type, tmp.attributes[type][i].name)
      } else {
        tmp.setTrue(type, tmp.attributes[type][i].name)
      }
    }
  }

  tmp.setTrue = (type, val) => {
    if (tmp.isSelected(type, val) === false) {
      tmp.selected[type][val] = true
      tmp.selected[type + '-count']++
    }
  }

  tmp.setFalse = (type, val) => {
    if (tmp.isSelected(type, val) === true) {
      tmp.selected[type][val] = false
      tmp.selected[type + '-count']--
    }
  }

  tmp.resetType = (type) => {
    for (var c in tmp.selected[type]) {
      if (tmp.selected[type].hasOwnProperty(c)) {
        tmp.selected[type][c] = false
      }
    }
    tmp.selected[type + '-count'] = 0
  }

  tmp.isCostFiltered = (cost) => {
    if (typeof tmp.selected.cost.min !== 'undefined' && cost < tmp.selected.cost.min) {
      return false
    } else if (typeof tmp.selected.cost.max !== 'undefined' && cost > tmp.selected.cost.max) {
      return false
    }
    return true
  }

  tmp.setCost = (cost) => {
    tmp.selected.cost = cost
  }

  tmp.setText = (type, val) => {
    tmp.selected.text[type] = val
  }

  tmp.resetAll = () => {
    tmp.resetType('classes')
    tmp.resetType('rarities')
    tmp.resetType('sets')
    tmp.resetType('types')
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
      'types-count': 0,
      cost: {},
      text: {
        name: '',
        text: ''
      }
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
