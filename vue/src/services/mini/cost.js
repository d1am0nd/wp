export default {
  parseCost (regex) {
    // Testing for c:1-12
    var str = /\b(\d+)-(\d+)\b/i.exec(regex)
    if (str !== null) {
      return { min: str[1], max: str[2] }
    }
    // Testing for c:1+
    str = /\b(\d+)(?=(\+|\b))(?!-)/i.exec(regex)
    if (str !== null) {
      return { min: str[1] }
    }
    // Testing for c:1-
    str = /\b(\d+)(?=-)/i.exec(regex)
    if (str !== null) {
      return { max: str[1] }
    }
    return {}
  },
  parseCostContent (regex) {
    return this.parseCost(regex)
  }
}
