<template>
  <div>
    <div class="flex">
      {{ count }}
    </div>
    <div class="flex flex-wrap">
      <WorksOverviewResultsItem
        v-for="item in results"
        :key="item.id"
        :item="item"
      />
    </div>
  </div>
</template>

<script>
import WorksOverviewResultsItem from './WorksOverviewResultsItem'

export default {
  components: {
    WorksOverviewResultsItem
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
