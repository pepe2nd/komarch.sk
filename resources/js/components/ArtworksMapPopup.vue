<template>
  <div>
    {{ artwork && artwork.properties.title }}
  </div>
</template>

<script>
export default {
  props: {
    artwork: {
      // TODO: fix null value
      type: Object,
      required: true
    }
  }
}
</script>
