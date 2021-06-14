<template>
  <div class="flex flex-wrap">
    <WorksOverviewResultsItem
      v-for="item in results"
      :key="item.id"
      :item="item"
    />
  </div>
</template>

<script>
import WorksOverviewResultsItem from './WorksOverviewResultsItem'

export default {
  components: { WorksOverviewResultsItem },
  props: {
    results: {
      type: Array,
      required: true
    }
  }
}
</script>
