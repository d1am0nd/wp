<template>
  <div class="cards">
    <input type="text" v-model="filter" placeholder="Filter by name">
    <div v-for="card in filteredCards">{{ card.name }}</div>
  </div>
</template>

<script>
export default {
  name: 'Cards',
  data () {
    return {
      filter: '',
      cards: this.$root.cards
    }
  },
  computed: {
    filteredCards () {
      var vm = this
      return this.cards.cards.filter((val, key) => {
        return vm.cards.attributes.canCardBePlayed(val) && val.name.toLowerCase().indexOf(vm.filter) !== -1
      })
    }
  }
}
</script>
