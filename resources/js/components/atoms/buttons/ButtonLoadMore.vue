<template>
  <div
    class="mt-10 h-20 flex items-center"
    v-on="$listeners"
  >
    <ButtonArrow
      v-if="!isLoading"
      class="text-xl"
    >
      {{ __('post.load_more') }}
    </ButtonArrow>
    <p v-else>
      {{ __('post.loading_more') }}
    </p>
  </div>
</template>

<script>
import ButtonArrow from './ButtonArrow'

export default {
  components: {
    ButtonArrow
  },
  props: {
    isLoading: {
      type: Boolean,
      default: false
    }
  }
}
</script>
