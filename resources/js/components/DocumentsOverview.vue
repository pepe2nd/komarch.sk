<template>
  <div>
    <DocumentsOverviewFilters v-model="selectedOptions" />
    <DocumentsOverviewResults :results="results" />
  </div>
</template>

<script>
import DocumentsOverviewResults from './DocumentsOverviewResults'
import DocumentsOverviewFilters from './DocumentsOverviewFilters'

export default {
  components: {
    DocumentsOverviewFilters,
    DocumentsOverviewResults
  },
  data () {
    return {
      selectedOptions: [],
      results: []
    }
  }
}
</script>
