<template>
  <div id="app">
    <div class="container">
        <MainHeader></MainHeader>
        <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Header from './components/general/Header'

export default {
  name: 'app',
  components: {
    MainHeader: Header
  }
}
</script>
