<template>
  <div class="advanced">
    <h1>Advanced Search</h1>
    <div class="small-help">
      <strong>Usage</strong>
      <p>Write whatever you want to add to filter into 'Advanced filter' input. Rules must be separated with space Example <code>pri leg 5-</code><br>
      Use the next shorthands to filter by that attribute. Symbols in <code>[]</code> are shorthands.</p>
    </div>
    <div class="row">
      <div class="six columns">
      <strong>Classes</strong><br>
      <code title="Druid">[dru]id</code>
      <code title="Hunter">[hun]ter</code>
      <code title="Mage">[mag]e</code>
      <code title="Paladin">[pal]adin</code>
      <code title="Priest">[pri]est</code>
      <code title="Rogue">[rog]ue</code>
      <code title="Shaman">[sha]man</code>
      <code title="Warlock">[warl]ock</code>
      <code title="Warrior">[warr]ior</code>
      <br>
      <strong>Rarities</strong><br>
      <code title="Free">[fre]e</code>
      <code title="Common">[com]mon</code>
      <code title="Rare">[rar]e</code>
      <code title="Epic">[epi]c</code>
      <code title="Legendary">[leg]endary</code>
      </div>
      <div class="six columns">
        <strong>Types</strong><br>
        <code title="Minon">[min]ion</code>
        <code title="Spell">[spe]ll</code>
        <code title="Weapon">[wea]pon</code>
        <br>
        <strong>Cost</strong><br>
        <code title="Between">2-5</code>
        <code title="More than">5+</code>
        <code title="Less than">0-</code>
      </div>
    </div>
    <div class="row">
      <div class="twelve columns">
        <strong>Classes</strong><br>
        <code
          v-for="s in cards.attributes.getAtts('sets')">{{ s.name.toLowerCase() }}</code>
      </div>
    </div>
    <input
      type="text"
      class="regex-input"
      placeholder="Advanced filter"
      v-model="regex.regex"
      style="margin-top: 10px">
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
    Meta.title('Advanced Hearthstone Card Search')
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
