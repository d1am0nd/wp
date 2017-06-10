<template>
  <div class="mini-filters">
    <div class="row">
      <div class="twelve columns">
        <input :autofocus="autofocus" type="text" v-if="name" v-model="filters.name" placeholder="Filter by name">
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
              class="no-style">Cost <span></span>
            </a>
          </li>
          <li>
            <a
              href="javascript:;"
              @click="toggleSort('name')"
              class="no-style">Name <span>{{ sort.nameIco }}</span>
            </a>
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
      sort: {
        nameIco: '',
        costIco: ''
      }
    }
  },
  methods: {
    setText () {
      this.$root.cards.attributes.setText('text', this.filters.text)
    },
    setName () {
      this.$root.cards.attributes.setText('name', this.filters.name)
    },
    setCost () {
      this.$root.cards.attributes.setCost(Cost.parseCostContent(this.filters.cost))
    },
    toggleSort (att) {
      this.$root.cards.cards.sortBy(att)
    }
  }
}
</script>
