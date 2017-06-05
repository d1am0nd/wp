<template>
  <div class="cards">
    <input type="text" v-model="filter" placeholder="Filter by name">
    <div
      class="row"
      v-for="(chunk, chunkKey) in chunks(filteredCards, 3)">
      <div
        class="four columns pointer"
        @click="goTo(card.slug)"
        v-for="(card, ckey) in chunk">
        <div
          v-if="chunkKey < 5">

          <p class="card-title"><strong>{{ card.name }}</strong></p>
          <div class="row">
            <div class="six columns">
              <img
                :alt="card.name"
                :title="card.name"
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
        return vm.cards.attributes.canCardBePlayed(val) && val.name.toLowerCase().indexOf(vm.lcFilter) !== -1
      })
    },
    lcFilter () {
      return this.filter.toLowerCase()
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
    goTo (slug) {
      this.$router.push({ name: 'card', params: { slug: slug } })
    },
    canShowRow (row) {
      console.log(row)
      return row < 5
    }
  }
}
</script>
<style type="text/css">
  p.small-card {
    margin-top: 10px;
  }
</style>
