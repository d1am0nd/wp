<template>
  <div class="advanced">
    <h1>Advanced Search</h1>
    <p class="summary">
      Write an expression for filtering Hearthstone cards using the rules below. Each rule has to be separated with space.<br>
      <button class="button button-sm" @click="tryExample(1)">Try example</button>
    </p>
    <p>
      <pre>{{ ex1 }}</pre>
    </p>
    <input
      type="text"
      class="regex-input"
      placeholder="Advanced filter"
      v-model="regex.regex">
    <Cards></Cards>
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
    },
    pushFilters (type, vals) {
      if (vals.length === 0) {
        this.cards.attributes.resetType(type)
        return
      }
      for (var i = 0; i < vals.length; i++) {
        this.cards.attributes.setTrue(type, vals[i].toUpperCase())
      }
    },
    tryExample (n) {
      console.log(this['ex' + n])
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
</style>
