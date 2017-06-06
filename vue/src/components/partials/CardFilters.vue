<template>
  <div class="card-filters">
    <div class="row">
      <div class="twelve rows">
        <strong>Type</strong>
        <ul class="filter-nav f-types">
          <li v-for="r in filters.getAtts('types')">
            <button
              v-bind:class="{ 'button-selected': filters.isFiltered('types', r.name) }"
              @click="toggle('types', r.name)"
              class="button">
              {{ r.name }}
            </button>
          </li>
        </ul>
        <strong>Rarity</strong>
        <ul class="filter-nav f-rarities">
          <li v-for="r in filters.getAtts('rarities')">
            <button
              v-bind:class="{ 'button-selected': filters.isFiltered('rarities', r.name) }"
              @click="toggle('rarities', r.name)"
              class="button">
              {{ r.name }}
            </button>
          </li>
        </ul>
        <strong>Set</strong>
        <ul class="filter-nav f-sets">
          <li v-for="r in filters.getAtts('sets')">
            <button
              v-bind:class="{ 'button-selected': filters.isFiltered('sets', r.name) }"
              @click="toggle('sets', r.name)"
              class="button">
              {{ r.name }}
            </button>
          </li>
        </ul>
        <strong>Class</strong>
        <ul class="filter-nav f-classes">
          <li v-for="r in filters.getAtts('classes')">
            <button
              v-bind:class="{ 'button-selected': filters.isFiltered('classes', r.name) }"
              @click="toggle('classes', r.name)"
              class="button">
              {{ r.name }}
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['filters'],
  name: 'card-filters',
  data () {
    return {
      selected: this.filters.solocted
    }
  },
  created () {
    setTimeout(() => {
      console.log(this.filters)
    }, 200)
  },
  methods: {
    toggleType (val) {
      this.filters.toggleType(val)
    },
    toggleRarity (val) {
      this.filters.toggleRarity(val)
    },
    toggleSet (val) {
      this.filters.toggleSet(val)
    },
    toggleClass (val) {
      this.filters.toggleClass(val)
    },
    toggle (type, val) {
      console.log(this.selected.sets)
      var newVal = this.filters.toggle(type, val)
      this.selected[type][val] = newVal
    }
  }
}
</script>
