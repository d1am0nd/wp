const defTitle = 'Wizard Poker'

var meta = {}

meta.title = (t) => {
  document.getElementById('meta-title').innerHTML = t + ' - ' + defTitle
}
meta.description = (d) => {
  document.getElementById('meta-desc').setAttribute('content', d)
  document.getElementById('og-desc').setAttribute('content', d)
}

export default meta
