export default {
  newCards (cards) {
    return new Cards(cards)
  }
}

const ATT_STR = ['name']
const ASC = 'asc'
const DESC = 'desc'

var sortByString = (str1, str2, order) => {
  var smaller = str1 < str2
  if ((smaller === true && order === ASC) || (smaller === false && order === DESC)) {
    return -1
  } else if ((smaller === false && order === ASC) || (smaller === true && order === DESC)) {
    return 1
  }
  return 0
}

var sortByInt = (int1, int2, order) => {
  if (order === DESC) {
    return int2 - int1
  }
  return int1 - int2
}

var Cards = (cards) => {
  var tmp = {}

  tmp.cards = cards
  tmp.sort = {
    attribute: 'cost',
    sort: ASC
  }

  tmp.sortBy = (att, sort = null) => {
    // Toggle
    if (sort === null) {
      if (tmp.sort.attribute === att && tmp.sort.sort === ASC) {
        tmp.sort.sort = DESC
      } else {
        tmp.sort.sort = ASC
      }
    } else {
      tmp.sort = sort
    }
    tmp.sort.attribute = att
    var sortString = (ATT_STR.indexOf(att) !== -1)
    tmp.getCards().sort((a, b) => {
      if (sortString === true) {
        return sortByString(a[att], b[att], tmp.sort.sort)
      }
      return sortByInt(a[att], b[att], tmp.sort.sort)
    })
  }

  tmp.getSortAtt = () => {
    return tmp.sort.attribute
  }

  tmp.getSort = () => {
    return tmp.sort.sort
  }

  tmp.getCount = () => {
    return tmp.cards.length
  }

  tmp.getCards = () => {
    return tmp.cards
  }

  tmp.setCards = (cards) => {
    tmp.cards = cards
  }

  return tmp
}
