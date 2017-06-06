export default {
  newAttributes (attJson) {
    return new Filters(attJson)
  }
}

var Attributes = (attJson) => {
  var tmp = {}

  tmp.attributes = attJson
  tmp.selected = {
    classes: [],
    mechanics: [],
    playReqs: [],
    rarities: [],
    sets: [],
    types: []
  }

  tmp.canCardBePlayed = (card) => {
    if (!tmp.isClassFiltered(card.class)) {
      return false
    } else if (!tmp.isMechanicFiltered(card.mechanic)) {
      return false
    } else if (!tmp.isRarityFiltered(card.rarity)) {
      return false
    } else if (!tmp.isSetFiltered(card.set)) {
      return false
    } else if (!tmp.isTypeFiltered(card.type)) {
      return false
    }
    return true
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

  return tmp
}
