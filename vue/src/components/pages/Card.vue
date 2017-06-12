<template>
  <div class="card">
    <h1>{{ card.name }}</h1>
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
              Cost: {{ card.cost }}
            </li>
            <li
              class="atts"
              v-if="card.atk">
              Atk: {{ card.atk }}
            </li>
            <li
              class="atts"
              v-if="card.hp">
              HP: {{ card.hp }}
            </li>
          </ul>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div
              title="Class"
              class="button button-sm">
              {{ card.class }}
            </div>
            <div
              title="Type"
              class="button button-sm">
              {{ card.type }}
            </div>
            <div
              title="Rarity"
              class="button button-sm">
              {{ card.rarity }}
            </div>
            <div
              title="Set"
              class="button button-sm">
              {{ card.set }}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <ul class="inline">
              <li>
                <a target="_blank" :href="card.wikia_url">See on Wikia </a>
              </li>
              <li>
                <a target="_blank" :href="card.gamepedia_url">See on Gamepedia </a>
              </li>
              <li>
                <a target="_blank" :href="card.hearthhead_url">See on Hearthhead </a>
              </li>
            </ul>
          </div>
        </div>
        <p
          class="small-card"
          v-html="card.text">
        </p>
      </div>
    </div>
    <div class="row">
      <div class="four columns offset-by-four">
        <router-link :to="{ name: 'home' }" class="button back">Back</router-link>
      </div>
      <div class="four columns">
      </div>
    </div>
  </div>
</template>

<script>
import Meta from '@/config/head'

export default {
  name: 'card',
  computed: {
    card () {
      return this.$root.cards.cards.getCards().find((e, i, a) => {
        return e.slug === this.$route.params.slug
      })
    }
  },
  watch: {
    'this.card': 'setMeta'
  },
  methods: {
    setMeta () {
      if (this.card === undefined) {
        return
      }
      Meta.title(this.card.name)
      Meta.description(this.card.text)
    }
  }
}
</script>
<style type="text/css" scoped>
  .att-list {
    font-size: 150%;
  }
  p {
    font-size: 150%;
  }
  .button.back {
    width: 100%;
  }
</style>
