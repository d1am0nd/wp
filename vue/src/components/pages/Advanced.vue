<template>
  <div class="advanced">
    <input
      type="text"
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
    Meta.description('Advanced responsive Hearthstone card search. ')
  },
  data () {
    return {
      cards: this.$root.cards,
      regex: RegexFilter.newRegexFilter('', this.$root.cards)
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
    }
  },
  watch: {
    'regex.regex': 'parseRegex'
  }
}
</script>
