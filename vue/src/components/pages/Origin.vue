<template>
  <div class="home">
    <h1>Name Origin</h1>
    <p>
      "<a href="https://www.reddit.com/r/hearthstone/comments/36qt9z/when_my_teacher_caught_me_playing_hearthstone_in/" class="no-style">Stop playin your damn Wizard Poker</a>" - /u/JewBrownie's teacher
    </p>
  </div>
</template>

<script>
import Meta from '@/config/head'

export default {
  name: 'origin',
  created () {
    Meta.title('Name Origin')
    Meta.description('The famed story of /u/JewBrownie. "Stop playin your damn Wizard Poker" and a new world was born')
  }
}
</script>
