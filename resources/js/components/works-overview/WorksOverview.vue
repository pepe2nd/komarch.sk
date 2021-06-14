<template>
  <div>
    <WorksOverviewFilters
      v-model="selectedFilters"
      :filters="filters"
    />
    <RangeSlider
      v-model="yearRange"
      :min="1000"
      :max="2021"
    />
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
import RangeSlider from '../atoms/RangeSlider'

const FILTER_AWARDS = 'awards'

export default {
  components: {
    RangeSlider,
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
      selectedFilters: [],
      yearRange: [1000, 2021],
      searchTerm: null,
      results: [],
      sorting: {
        name: null,
        year: null
      },
      page: 1,
      hasNextPage: true
    }
  },
  computed: {
    filterParams () {
      const params = {
        awards: this.selectedFilters.filter(filter => filter.type === FILTER_AWARDS).map(filter => filter.title)
      }

      if (this.sorting.name) {
        params.sortby = 'name'
        params.direction = this.sorting.name
      }

      if (this.sorting.year) {
        params.sortby = 'created_at'
        params.direction = this.sorting.year
      }

      if (this.searchTerm) {
        params.q = this.searchTerm
      }

      return params
    }
  },
  watch: {
    searchTerm () {
      const debounceTime = 300
      clearTimeout(this.searchTermDebounceTimeout)

      this.searchTermDebounceTimeout = setTimeout(() => {
        this.fetchData()
      }, debounceTime)
    },
    sorting () {
      this.fetchData()
    },
    selectedFilters () {
      this.fetchData()
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

      const awards = []

      for (const key in filtersResponse.awards) {
        awards.push({ key: key, title: key, items: filtersResponse.awards[key], type: FILTER_AWARDS })
      }

      this.filters = {
        awards
      }

      this.results = worksResponse.data
      this.hasNextPage = worksResponse.meta.current_page < worksResponse.meta.last_page
    },
    async onLoadMore () {
      const params = {
        ...this.filterParams,
        page: this.page + 1
      }

      const worksResponse = await this.axiosGet('works', params)

      this.page = worksResponse.meta.current_page
      this.hasNextPage = worksResponse.meta.current_page < worksResponse.meta.last_page
      this.results.push(...worksResponse.data)
    }
  }
}
</script>
