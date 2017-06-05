<template>
  <section class="header">
    <div class="title"><router-link :to="{ name: 'home' }" class="no-style">Wizard Poker</router-link> | <router-link :to="{ name: 'origin' }" class="no-style">Name Origin</router-link> | Hearthstone Card Search</div>
  </section>
</template>

<script>
export default {
  name: 'Header'
}
</script>
<style type="text/css" scoped>
  .title {
    border-bottom: 1px solid #E1E1E1;
  }
  .header {
    margin-bottom: 10px;
  }
</style>
