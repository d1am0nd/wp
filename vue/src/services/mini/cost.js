export default {
  parseCost (regex) {
    // Testing for c:1-12
    var str = /(c|costs?)(:\s?|\s)(\d+)-(\d+)/i.exec(regex)
    if (str !== null) {
      return { min: str[3], max: str[4] }
    }
    // Testing for c:1+
    str = /(c|costs?)(:\s?|\s)(\d+)\+?(?!-)/.exec(regex)
    if (str !== null) {
      return { min: str[3] }
    }
    // Testing for c:1-
    str = /(c|costs?)(:\s?|\s)(\d+)-/.exec(regex)
    if (str !== null) {
      return { max: str[3] }
    }
    return {}
  },
  parseCostContent (regex) {
    // Testing for c:1-12
    var str = /(\d+)-(\d+)/i.exec(regex)
    if (str !== null) {
      return { min: str[1], max: str[2] }
    }
    // Testing for c:1+
    str = /(\d+)\+?(?!-)/i.exec(regex)
    if (str !== null) {
      return { min: str[1] }
    }
    // Testing for c:1-
    str = /(\d+)-/i.exec(regex)
    if (str !== null) {
      return { max: str[1] }
    }
    return {}
  }
}