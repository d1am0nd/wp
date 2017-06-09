<template>
  <div class="advanced">
    <h1>Advanced Search</h1>
    <p class="summary">
      Write an expression for filtering Hearthstone cards using the rules below. Each rule has to be separated with space.
    </p>
    <div class="small-help">
      <strong>Usage</strong>
      <p>Rules follow next pattern: <code>{attribute}:{value1},{value2}...</code>. Multiple rules are separated by space: <code>{a1}:{v1} {a2}:{v2}...</code></p>
      <strong>Attributes and values</strong>
      <p>
      Use next rules followed by values to filter by this attribute. Symbols in <code>[]</code> are shorthands.
      </p>
      <div class="row">
        <div class="six columns">
          <strong>Class</strong><br>
          rule <code>[c]lass</code><br>
          values
          <code title="Druid">dru</code>
          <code title="Hunter">hun</code>
          <code title="Mage">mag</code>
          <code title="Paladin">pal</code>
          <code title="Priest">pri</code>
          <code title="Rogue">rog</code>
          <code title="Shaman">sha</code>
          <code title="Warlock">warl</code>
          <code title="Warrior">warr</code>
          <br>
          <strong>Rarity</strong><br>
          rule <code>[r]arity</code><br>
          values
          <code title="Free">f</code>
          <code title="Common">c</code>
          <code title="Rare">r</code>
          <code title="Epic">e</code>
          <code title="Legendary">l</code>
          (free, common, rare, epic, legendary)
        </div>
        <div class="six columns">
          <strong>Type</strong><br>
          rule <code>[t]ype</code><br>
          values
          <code title="Minon">m</code>
          <code title="Spell">c</code>
          <code title="Weapon">r</code>
          (minion, spell, weapon)
          <br>
          <strong>Cost</strong><br>
          rule <code>[c]ost</code><br>
          values
          <code title="Between">2-5</code>
          <code title="More than">5+</code>
          <code title="Less than">0-</code>
          (between, more than, less than)
          </p>
        </div>
      </div>
    </div>
    <input
      type="text"
      class="regex-input"
      placeholder="Advanced filter"
      v-model="regex.regex">
    <Cards :name="true" :text="true"></Cards>
  </div>
</template>

<script>
import CardFilters from '@/components/partials/CardFilters'
import Cards from '@/components/partials/Cards'
import Meta from '@/config/head'
import RegexFilter from '@/services/data/regexfilter'

export default {
  name: 'advanced',
  components: {
    CardFilters: CardFilters,
    Cards: Cards
  },
  created () {
    Meta.title('Hearthstone Card Search')
    Meta.description('Advanced responsive Hearthstone card search')
  },
  data () {
    return {
      cards: this.$root.cards,
      regex: RegexFilter.newRegexFilter('', this.$root.cards),
      ex1: 'rarities:r,l,c classes:warr,warl,pri,pal,rog,hun types:s'
    }
  },
  methods: {
    parseRegex () {
      this.pushFilters('types', this.regex.parseTypes())
      this.pushFilters('classes', this.regex.parseClasses())
      this.pushFilters('rarities', this.regex.parseRarities())
      this.pushFilters('sets', this.regex.parseSets())
      this.cards.attributes.setCost(this.regex.parseCost())
    },
    pushFilters (type, vals) {
      if (vals.length === 0) {
        this.cards.attributes.resetType(type)
        return
      }
      var arr = []
      for (var i = 0; i < vals.length; i++) {
        arr.push(vals[i].toUpperCase())
      }
      this.cards.attributes.setTrueArr(type, arr)
    },
    tryExample (n) {
      this.regex.setRegex(this['ex' + n])
    }
  },
  watch: {
    'regex.regex': 'parseRegex'
  }
}
</script>
<style type="text/css">
  .regex-input {
    width: 100%;
  }
  .small-help {
    font-size: 80%;
  }
</style>
