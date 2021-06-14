<template>
  <div>
    <WorksOverviewFilters />
    <WorksOverviewResults :results="results" />
  </div>
</template>

<script>
import axiosGet from '../axiosGetMixin'
import WorksOverviewFilters from './WorksOverviewFilters'
import WorksOverviewResults from './WorksOverviewResults'

export default {
  components: {
    WorksOverviewFilters,
    WorksOverviewResults
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      results: [],
      page: 1,
      hasNextPage: true
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      const [worksResponse, filtersResponse] = await Promise.all([
        this.axiosGet('works', this.filterParams),
        this.axiosGet('works-filters', this.filterParams)
      ])

      this.results = worksResponse.data
    }
  }
}
</script>
