<template>
  <div>
    <img
      :src="image.url"
      :srcset="image.srcset"
      :alt="image.alt"
      class="h-80 mx-auto cursor-zoom-in"
    >
  </div>
</template>

<script>
export default {
  props: {
    image: {
      type: Object,
      required: true
    }
  }
}
</script>
