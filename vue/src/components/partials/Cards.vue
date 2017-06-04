<template>
  <div class="cards">
    <input type="text" v-model="filter" placeholder="Filter by name">
    <lazy-component @show="test">
      <div
        class="row"
        v-for="(chunk, chunkKey) in chunks(filteredCards, 3)">
        <div
          class="four columns"
          v-for="(card, ckey) in chunk">
          <p class="card-title"><strong>{{ card.name }}</strong></p>
          <div class="row">
            <div class="six columns">
              <img
                class="u-max-full-width"
                v-lazy="card.image_path">
            </div>
            <div class="six columns">
              <div class="simple-border-bot">
                <ul class="att-list">
                    <li
                      class="atts"
                      v-if="typeof card.cost !== 'undefined'">
                      C: {{ card.cost }}
                    </li>
                    <li
                      class="atts"
                      v-if="card.atk">
                      A: {{ card.atk }}
                    </li>
                    <li
                      class="atts"
                      v-if="card.hp">
                      HP: {{ card.hp }}
                    </li>
                </ul>
              </div>
              <p
                class="small-card"
                v-html="card.text">
              </p>
            </div>
          </div>
        </div>
      </div>
    </lazy-component>
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
    },
    test () {
      console.log('s')
    }
  }
}
</script>
<style type="text/css">
  p.small-card {
    margin-top: 10px;
  }
</style>
