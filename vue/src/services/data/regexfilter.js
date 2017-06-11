import Cost from '@/services/mini/cost'

export default {
  newRegexFilter (regex, cards) {
    return new Filters(regex, cards)
  }
}

var Filters = (regex, cards = {}) => {
  var tmp = {}

  tmp.attributes = {
    allTypes: /\b(min(i|ion)?|spe(l{1,2})?|we(ap|p)?(on)?)\b/ig,
    allClasses: /\b(neu(t|tral)?|pri(s|est)?|mage?|pal(a|adin)?|sha(m|man)?|hun(t|ter)?|ro(g|u|gue)|dru(id)?|(warr(ior)?|wrr)|(wl[ck]|warl(ock)?))\b/ig,
    allRarities: /\b(free?|(cmn|com(mon)?)|rare?|epic?|leg(endary)?)\b/ig,

    types: {
      minion: 'min(i|ion)?',
      spell: 'spe(l{1,2})?',
      weapon: 'we(ap|p)?(on)?'
    },

    classes: {
      neutral: 'neu(t|tral)?',
      priest: 'pri(s|est)?',
      mage: 'mage?',
      paladin: 'pal(a|adin)?',
      shaman: 'sha(m|man)?',
      hunter: 'hun(t|ter)?',
      rogue: 'ro(g|u|gue)',
      druid: 'dru(id)?',
      warrior: '(warr(ior)?|wrr)',
      warlock: '(wl[ck]|warl(ock)?)'
    },

    rarities: {
      free: 'free?',
      common: '(cmn|com(mon)?)',
      rare: 'rare?',
      epic: 'epic?',
      legendary: 'leg(endary)?'
    }
  }

  tmp.cards = cards
  tmp.regex = regex

  tmp.parseTypes = () => {
    var types = tmp.regex.match(tmp.attributes.allTypes)
    return tmp.shortArrayToLong('types', types)
  }

  tmp.parseClasses = () => {
    var types = tmp.regex.match(tmp.attributes.allClasses)
    return tmp.shortArrayToLong('classes', types)
  }

  tmp.parseRarities = () => {
    var types = tmp.regex.match(tmp.attributes.allRarities)
    return tmp.shortArrayToLong('rarities', types)
  }

  tmp.parseSets = () => {
    return tmp.shortToLong(tmp.getSets())
  }

  tmp.parseCost = () => {
    return Cost.parseCost(tmp.regex)
  }

  tmp.transformSets = (fromDb) => {
    var sets = {}
    for (var i in fromDb) {
      sets[fromDb[i].name.toLowerCase()] = fromDb[i].name.toLowerCase()
    }
    return sets
  }

  tmp.shortArrayToLong = (type, arr) => {
    var parsed = []
    // Loop through array
    for (var i in arr) {
      // Loop through this type's regexes
      for (var t in tmp.attributes[type]) {
        if (tmp.attributes[type].hasOwnProperty(t)) {
          // Do the regex on current array index
          var regex = new RegExp('\\b' + tmp.attributes[type][t] + '\\b')
          if (arr[i].match(regex) !== null && parsed.indexOf(t) === -1) {
            parsed.push(t)
          }
        }
      }
    }
    return parsed
  }

  /**
   * Transforms shorthands into actual names
   */
  tmp.shortToLong = (arr) => {
    var parsed = []
    for (var t in arr) {
      var regex = arr[t]
      if (tmp.regex.match(new RegExp('\\b' + regex + '\\b', 'i')) !== null) {
        parsed.push(t)
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
