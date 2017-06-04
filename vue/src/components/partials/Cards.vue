<template>
  <div class="cards">
    <input type="text" v-model="filter" placeholder="Filter by name">
    <div
      class="row"
      v-for="(chunk, chunkKey) in chunks(filteredCards, 3)">
      <div
        class="four columns"
        v-for="(card, ckey) in chunk">
        <div class="row">
          <div class="six columns">
            <img
              v-if="((chunkKey * 3) + ckey) < 18"
              class="u-max-full-width"
              :src="card.image_path">
          </div>
          <div class="six columns">
            <strong>{{ card.name }}</strong>
            <ul class="card-list">
                <li class="atts">
                  <button class="button button-sm">{{ card.type.toLowerCase() }}</button>
                </li>
                <li class="atts">
                  <button class="button button-sm">{{ card.rarity.toLowerCase() }}</button>
                </li>
                <li class="atts">
                  <button class="button button-sm">{{ card.set.toLowerCase() }}</button>
                </li>
                <li class="atts">
                  <button class="button button-sm">{{ card.class.toLowerCase() }}</button>
                </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
  },
  methods: {
    chunks (array, chunk) {
      var tmp = []
      for (var i = 0, j = array.length; i < j; i += chunk) {
        tmp.push(array.slice(i, i + chunk))
      }
      return tmp
    }
  }
}
</script>
