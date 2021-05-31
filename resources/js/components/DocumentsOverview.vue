<template>
  <div>
    <DocumentsOverviewFilters v-model="selectedFilters" />
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
      selectedFilters: [],
      results: []
    }
  },
  watch: {
    selectedOptions: {
      immediate: true,
      async handler (newValue) {
        const response = await axios.get('./api/documents')
        this.results = response.data.data
      }
    }
  }
}
</script>
