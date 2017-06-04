export default {
  newAttributes (attJson) {
    return new Attributes(attJson)
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
    console.log(tmp.selected.classes.indexOf(className))
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

  tmp.getMechanics = () => {
    return tmp.attributes.mechanics
  }

  tmp.toggleMechanic = (mechanic) => {
    if (tmp.isMechanicSelected(mechanic)) {
      tmp.removeMechanic(mechanic)
    } else {
      tmp.addMechanic(mechanic)
    }
  }

  tmp.addMechanic = (mechanic) => {
    tmp.selected.mechanics.push(mechanic)
  }

  tmp.removeMechanic = (mechanic) => {
    var i = tmp.selected.mechanics.indexOf(mechanic)
    if (i !== -1) {
      tmp.selected.mechanics.splice(i, 1)
    }
  }

  tmp.isMechanicSelected = (mechanic) => {
    return tmp.selected.mechanics.indexOf(mechanic) !== -1
  }

  tmp.isMechanicFiltered = (mechanic) => {
    return (tmp.selected.mechanics.length === 0) || tmp.selected.mechanics.indexOf(mechanic) !== -1
  }

  tmp.getPlayReqs = () => {
    return tmp.attributes.play_reqs
  }

  tmp.togglePlayReq = (playReq) => {
    if (tmp.isPlayReqSelected(playReq)) {
      tmp.removePlayReq(playReq)
    } else {
      tmp.addPlayReq(playReq)
    }
  }

  tmp.addPlayReq = (playReq) => {
    tmp.selected.playReqs.push(playReq)
  }

  tmp.removePlayReq = (playReq) => {
    var i = tmp.selected.playReqs.indexOf(playReq)
    if (i !== -1) {
      tmp.selected.playReqs.splice(i, 1)
    }
  }

  tmp.isPlayReqSelected = (playReq) => {
    return tmp.selected.playReqs.indexOf(playReq) !== -1
  }

  tmp.isPlayReqFiltered = (playReq) => {
    return (tmp.selected.playReqs.length === 0) || tmp.selected.playReqs.indexOf(playReq) !== -1
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
  }

  tmp.getAttributes = () => {
    return tmp.attributes
  }

  return tmp
}
