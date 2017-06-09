<template>
  <div class="mini-filters">
    <input :autofocus="autofocus" type="text" v-if="name" v-model="filters.name" placeholder="Filter by name">
    <input type="text" v-if="text" v-model="filters.text" placeholder="Filter by card text">
    <input type="text" v-if="cost" v-model="filters.cost" placeholder="Filter by cost">
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
  methods: {
    setText () {
      this.$root.cards.attributes.setText('text', this.filters.text)
    },
    setName () {
      this.$root.cards.attributes.setText('name', this.filters.name)
    },
    setCost () {
      this.$root.cards.attributes.setCost(Cost.parseCostContent(this.filters.cost))
    }
  }
}
</script>
