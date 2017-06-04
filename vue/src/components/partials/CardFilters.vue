<template>
  <div class="card-filters">
    <div class="row">
      <div class="twelve rows">
        <ul class="filter-nav f-types">
          <li v-for="r in filters.getTypes()">
            <button
              v-bind:class="{ 'button-selected': filters.isTypeSelected(r.name) }"
              @click="toggleType(r.name)"
              class="button">
              {{ r.name }}
            </button>
          </li>
        </ul>
        <ul class="filter-nav f-rarities">
          <li v-for="r in filters.getRarities()">
            <button
              v-bind:class="{ 'button-selected': filters.isRaritySelected(r.name) }"
              @click="toggleRarity(r.name)"
              class="button">
              {{ r.name }}
            </button>
          </li>
        </ul>
        <ul class="filter-nav f-sets">
          <li v-for="r in filters.getSets()">
            <button
              v-bind:class="{ 'button-selected': filters.isSetSelected(r.name) }"
              @click="toggleSet(r.name)"
              class="button">
              {{ r.name }}
            </button>
          </li>
        </ul>
        <ul class="filter-nav f-classes">
          <li v-for="r in filters.getClasses()">
            <button
              v-bind:class="{ 'button-selected': filters.isClassSelected(r.name) }"
              @click="toggleClass(r.name)"
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
    }
  }
}
</script>
