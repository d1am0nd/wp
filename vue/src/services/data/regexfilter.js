import Cost from '@/services/mini/cost'

export default {
  newRegexFilter (regex, cards) {
    return new Filters(regex, cards)
  }
}

var Filters = (regex, cards = {}) => {
  var tmp = {}

  tmp.attributes = {
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
    return tmp.shortToLong(tmp.attributes['types'])
  }

  tmp.parseClasses = () => {
    return tmp.shortToLong(tmp.attributes['classes'])
  }

  tmp.parseRarities = () => {
    return tmp.shortToLong(tmp.attributes['rarities'])
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
