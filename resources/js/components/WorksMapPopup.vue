<template>
  <div
    v-if="artwork && artwork.properties"
    class="p-2"
  >
    <!-- TODO: add artwork preview image once available -->
    <h3>
      {{ artwork.properties.title }}
    </h3>
    <p>
      {{ artwork.properties.description }}
    </p>
    <LinkArrow
      :url="artwork.properties.url"
      class="mt-3"
    >
      {{ __('buildings.building_more') }}
    </LinkArrow>
  </div>
</template>

<script>
import LinkArrow from './atoms/links/LinkArrow'

export default {
  components: {
    LinkArrow
  },
  props: {
    artwork: {
      type: Object,
      required: true
    }
  }
}
</script>
