<template>
  <div class="home">
    <h1>Wizard Poker</h1>
    <CardFilters :filters="cards.attributes"></CardFilters>
    <Cards></Cards>
  </div>
</template>

<script>
import CardFilters from '@/components/partials/CardFilters'
import Cards from '@/components/partials/Cards'
import Meta from '@/config/head'

export default {
  name: 'home',
  components: {
    CardFilters: CardFilters,
    Cards: Cards
  },
  created () {
    Meta.title('Hearthstone Card Search')
    Meta.description('Quick responsive Hearthstone card search. Named after a viral Reddit post. Named after /u/JewBrownie Reddit post')
  },
  data () {
    return {
      cards: this.$root.cards
    }
  }
}
</script>
