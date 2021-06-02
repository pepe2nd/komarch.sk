<template>
  <ButtonArrow
    class="text-xl mt-10 h-20"
    v-on="$listeners"
  >
    {{ __('generic.load_more') }}
  </ButtonArrow>
</template>

<script>
import ButtonArrow from './ButtonArrow'

export default {
  components: {
    ButtonArrow
  }
}
</script>
