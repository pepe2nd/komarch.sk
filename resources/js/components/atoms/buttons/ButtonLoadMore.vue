<template>
  <ButtonArrow
    class="text-xl mt-10 h-20"
    v-on="$listeners"
  >
    {{ loadMore }}
  </ButtonArrow>
</template>

<script>
import ButtonArrow from './ButtonArrow'

export default {
  components: {
    ButtonArrow
  },
  props: {
    loadMore: {
      type: String,
      default: 'Load more'
    }
  }
}
</script>
