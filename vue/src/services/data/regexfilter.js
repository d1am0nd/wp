export default {
  newRegexFilter (regex, cards) {
    return new Filters(regex, cards)
  }
}

var Filters = (regex, cards = {}) => {
  var tmp = {}

  tmp.attributes = {
    types: {
      minion: 'm',
      spell: 's',
      weapon: 'w'
    },

    classes: {
      neutral: 'neu',
      priest: 'pri',
      mage: 'mag',
      paladin: 'pal',
      shaman: 'sha',
      hunter: 'hun',
      rogue: 'rog',
      druid: 'dru',
      warrior: 'warr',
      warlock: 'warl'
    },

    rarities: {
      free: 'f',
      common: 'c',
      rare: 'r',
      epic: 'e',
      legendary: 'l'
    }
  }

  tmp.cards = cards
  tmp.regex = regex

  tmp.parseTypes = () => {
    var str = /(t|types?)(:|\s)\s?([^\s]+)/i.exec(tmp.regex)
    if (str === null) {
      return []
    }
    var contents = str[3]
    return tmp.parseType(contents, tmp.attributes.types)
  }

  tmp.parseClasses = () => {
    var str = /(c|classe?s?)(:|\s)\s?([^\s]+)/i.exec(tmp.regex)
    if (str === null) {
      return []
    }
    var contents = str[3]
    return tmp.parseType(contents, tmp.attributes.classes)
  }

  tmp.parseRarities = () => {
    var str = /(r|rarity|rarities)(:|\s)\s?([^\s]+)/i.exec(tmp.regex)
    if (str === null) {
      return []
    }
    var contents = str[3]
    return tmp.parseType(contents, tmp.attributes.rarities)
  }

  tmp.parseSets = () => {
    if (typeof tmp.cards.attributes === 'undefined') {
      return []
    }
    var str = /(s|sets?)(:|\s)\s?([^\s]+)/i.exec(tmp.regex)
    if (str === null) {
      return []
    }
    var contents = str[3]
    return tmp.parseType(contents, tmp.getSets())
  }

  tmp.transformSets = (fromDb) => {
    var sets = {}
    for (var i in fromDb) {
      sets[fromDb[i].name.toLowerCase()] = fromDb[i].name.toLowerCase()
    }
    return sets
  }

  tmp.parseType = (contents, typeJson) => {
    var parsed = []
    for (var type in typeJson) {
      if (typeJson.hasOwnProperty(type)) {
        if (contents.indexOf(typeJson[type]) !== -1) {
          parsed.push(type)
        }
      }
    }
    return parsed
  }

  tmp.setRegex = (regex) => {
    tmp.regex = regex
  }

  tmp.setSets = (sets) => {
    tmp.attributes.sets = sets
  }

  tmp.getSets = () => {
    return tmp.transformSets(tmp.cards.attributes.getAtts('sets'))
  }

  return tmp
}