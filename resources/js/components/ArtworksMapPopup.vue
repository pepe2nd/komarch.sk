<template>
  <div v-if="artwork.properties">
    {{ artwork && artwork.properties.title }}
  </div>
</template>

<script>
export default {
  props: {
    artwork: {
      type: Object,
      required: true
    }
  }
}
</script>
