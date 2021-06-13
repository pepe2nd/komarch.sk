<template>
  <div v-if="artwork && artwork.properties">
    <!-- TODO: add artwork preview image once available -->
    <h3>
      {{ artwork.properties.title }}
    </h3>
    <p>
      {{ artwork.properties.description }}
    </p>
    <a :href="artwork.properties.url">
      Viac o diele
    </a>
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
