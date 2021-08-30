<template>
  <div
    v-if="artwork && artwork.properties"
    class="p-2"
  >
    <!-- TODO: add artwork preview image once available -->
    <h3>
      {{ artwork.properties.title }}
    </h3>
    <span
      v-for="architect in JSON.parse(artwork.properties.architects)"
      class="group inline-block leading-relaxed mr-2"
    >
      {{ architect }}
    </span>

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
