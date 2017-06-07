export default {
  newRegexFilter (regex) {
    return new Filters(regex)
  }
}

var Filters = (regex) => {
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
    }
  }

  tmp.regex = regex

  tmp.parseTypes = () => {
    var str = /(t|types?):\s?([^\s]+)/i.exec(tmp.regex)
    if (str === null) {
      return []
    }
    var contents = str[2]
    return tmp.parseType(contents, tmp.attributes.types)
  }

  tmp.parseClasses = () => {
    var str = /(classe?s?):\s?([^\s]+)/i.exec(tmp.regex)
    if (str === null) {
      return []
    }
    var contents = str[2]
    return tmp.parseType(contents, tmp.attributes.classes)
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

  return tmp
}
