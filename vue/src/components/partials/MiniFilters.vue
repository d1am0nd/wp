<template>
  <div class="mini-filters">
    <div class="row">
      <div class="twelve columns">
        <input type="text" v-if="text" v-model="filters.text" placeholder="Filter by card text">
        <input type="text" v-if="cost" v-model="filters.cost" placeholder="Filter by cost">
      </div>
    </div>
      <div class="twelve columns">
        <ul class="inline">
          <li>
            <a
              href="javascript:;"
              @click="toggleSort('cost')"
              class="no-style">Cost</a>
            <span>{{ sortIcons.cost }}</span>
          </li>
          <li>
            <a
              href="javascript:;"
              @click="toggleSort('name')"
              class="no-style">Name</a> <span>{{ sortIcons.name }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
import Cost from '@/services/mini/cost'

export default {
  name: 'MiniFilters',
  props: ['filters', 'name', 'text', 'cost', 'autofocus'],
  watch: {
    'filters.text': 'setText',
    'filters.name': 'setName',
    'filters.cost': 'setCost'
  },
  data () {
    return {
      sortIcons: {
        name: '',
        cost: '⇩'
      },
      icons: {
        down: '⇩',
        up: '⇧'
      }
    }
  },
  methods: {
    setText () {
      this.$root.cards.attributes.setText('main', this.filters.text)
    },
    setCost () {
      this.$root.cards.attributes.setCost(Cost.parseCostContent(this.filters.cost))
    },
    toggleSort (att) {
      var order = this.$root.cards.cards.sortBy(att)
      var ico = (order === 'asc' ? this.icons.down : this.icons.up)
      for (var v in this.sortIcons) {
        if (this.sortIcons.hasOwnProperty(v)) {
          this.sortIcons[v] = ''
          if (v === att) {
            this.sortIcons[v] = ico
          }
        }
      }
    }
  }
}
</script>
