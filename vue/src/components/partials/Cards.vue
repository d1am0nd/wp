<template>
  <div class="cards">
    <MiniFilters :filters="filters" :name="name" :text="text" :cost="cost"></MiniFilters>
    <div
      class="row"
      v-for="(chunk, chunkKey) in chunks(filteredCards, 3)">
      <div
        class="four columns pointer"
        @click="goTo(card.slug)"
        v-for="(card, ckey) in chunk">
        <div
          v-if="chunkKey < rowsDisplayed">

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
    <infinite-loading
      :on-infinite="incRowsDisplayed"
      ref="infiniteLoading"
      v-if="rowsDisplayed < filteredCards.length"></infinite-loading>
  </div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading'
import MiniFilters from '@/components/partials/MiniFilters'

const ROWS_DISPLAYED = 10

export default {
  name: 'Cards',
  components: {
    InfiniteLoading: InfiniteLoading,
    MiniFilters: MiniFilters
  },
  props: ['name', 'text', 'cost'],
  data () {
    return {
      filters: { name: '', text: '', cost: '' },
      cards: this.$root.cards,
      rowsDisplayed: ROWS_DISPLAYED
    }
  },
  watch: {
    'filteredCards': 'resetRowsDisplayed'
  },
  computed: {
    filteredCards () {
      var vm = this
      return this.cards.cards.filter((val, key) => {
        return vm.cards.attributes.canCardBePlayed(val)
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
    goTo (slug) {
      this.$router.push({ name: 'card', params: { slug: slug } })
    },
    canShowRow (row) {
      return row < this.rowsDisplayeds
    },
    incRowsDisplayed () {
      if (this.rowsDisplayed + ROWS_DISPLAYED >= this.filteredCards.length) {
        this.rowsDisplayed = this.filteredCards.length
      } else {
        this.rowsDisplayed = this.rowsDisplayed + ROWS_DISPLAYED
        this.$refs.infiniteLoading.$emit('$InfiniteLoading:loaded')
      }
    },
    resetRowsDisplayed () {
      this.rowsDisplayed = ROWS_DISPLAYED
    }
  }
}
</script>
<style type="text/css">
  p.small-card {
    margin-top: 10px;
  }
</style>
