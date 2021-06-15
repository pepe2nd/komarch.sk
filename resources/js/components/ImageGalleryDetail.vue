<template>
  <div>
    <img
      :src="image.src.replace('localhost', 'localhost:8000')"
      :alt="image.alt"
      class="h-80 mx-auto cursor-pointer"
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
