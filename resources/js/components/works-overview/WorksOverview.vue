<template>
  <div>
    <WorksOverviewFilters />
    <InputSearch
      v-model="searchTerm"
      class="mt-16 md:mt-8 md:max-w-sm"
      :placeholder="__('works.search_placeholder')"
    />
    <WorksOverviewResults
      v-model="sorting"
      :results="results"
    />
    <ButtonLoadMore
      v-if="hasNextPage"
      class="md:mt-24"
      @click="onLoadMore"
    />
  </div>
</template>

<script>
import axiosGet from '../axiosGetMixin'
import WorksOverviewFilters from './WorksOverviewFilters'
import WorksOverviewResults from './WorksOverviewResults'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'
import InputSearch from '../atoms/InputSearch'

export default {
  components: {
    WorksOverviewFilters,
    WorksOverviewResults,
    ButtonLoadMore,
    InputSearch
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      results: [],
      searchTerm: null,
      sorting: {
        name: null,
        year: null
      },
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
      this.hasNextPage = worksResponse.meta.current_page < worksResponse.meta.last_page
    },
    onLoadMore () {
      // TODO: implement
    }
  }
}
</script>
