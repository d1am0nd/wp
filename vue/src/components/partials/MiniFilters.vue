<template>
  <div class="mini-filters">
    <input type="text" v-if="name" v-model="filters.name" placeholder="Filter by name">
    <input type="text" v-if="text" v-model="filters.text" placeholder="Filter by card text">
    <input type="text" v-if="cost" v-model="filter.cost" placeholder="Filter by cost">
  </div>
</template>
<script type="text/javascript">
export default {
  name: 'MiniFilters',
  props: ['filters', 'name', 'text', 'cost'],
  watch: {
    'filters.text': 'setText',
    'filters.name': 'setName'
  },
  methods: {
    setText () {
      this.$root.cards.attributes.setText('text', this.filters.text)
    },
    setName () {
      this.$root.cards.attributes.setText('name', this.filters.name)
    },
    setCost () {

    }
  }
}
</script>
