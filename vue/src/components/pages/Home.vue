<template>
  <div class="home">
    <h1>Wizard poker</h1>
    <CardFilters :filters="cards.attributes"></CardFilters>
    <Cards></Cards>
  </div>
</template>

<script>
import CardFilters from '@/components/partials/CardFilters'
import Cards from '@/components/partials/Cards'
export default {
  name: 'home',
  components: {
    CardFilters: CardFilters,
    Cards: Cards
  },
  data () {
    return {
      cards: this.$root.cards
    }
  }
}
</script>
