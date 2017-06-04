<template>
  <div class="cards">
    <div v-for="card in filteredCards">{{ card.name }}</div>
  </div>
</template>

<script>
export default {
  name: 'Cards',
  data () {
    return {
      cards: this.$root.cards
    }
  },
  computed: {
    filteredCards () {
      var vm = this
      return this.cards.cards.filter((val, key) => {
        console.log(vm.cards.attributes.canCardBePlayed(val))
        return vm.cards.attributes.canCardBePlayed(val)
      })
    }
  }
}
</script>
