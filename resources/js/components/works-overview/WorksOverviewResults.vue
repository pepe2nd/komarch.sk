<template>
  <div class="mt-16">
    <div class="flex">
      {{ count }}
    </div>
    <div class="flex flex-wrap">
      <WorkTeaserBig
        v-for="item in results"
        :key="item.id"
        :item="item"
        class="w-1/4"
      />
    </div>
  </div>
</template>

<script>
import WorkTeaserBig from '../WorkTeaserBig'

export default {
  components: {
    WorkTeaserBig
  },
  props: {
    results: {
      type: Array,
      required: true
    }
  },
  computed: {
    count () {
      // TODO: add localization / plural forms
      return `(${this.results.length}) Objektov`
    }
  }
}
</script>
