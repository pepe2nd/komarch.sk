<template>
  <!-- TODO: Implement a nice spinner for loading state -->
  <div>
    <ContestsOverviewFilters
      :value="selectedFilters"
      :filters="filters"
      @input="onSelectedFiltersChange"
    />
    <InputSearch
      :value="searchTerm"
      class="mt-16 md:mt-8 md:max-w-sm"
      :placeholder="__('contests.search_placeholder')"
      @input="onSearchTermChange"
    />
    <ContestsOverviewResults
      :sort="sorting"
      :results="results"
      :total="total"
      @sort="onSortChange"
    />
    <ButtonLoadMore
      v-if="hasNextPage"
      class="md:mt-24"
      @click="onLoadMore"
    />
  </div>
</template>

<script>
import ContestsOverviewResults from './ContestsOverviewResults'
import ContestsOverviewFilters from './ContestsOverviewFilters'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'
import InputSearch from '../atoms/InputSearch'
import axiosGet from '../axiosGetMixin'
import isEqual from 'lodash/isEqual'
import isEmpty from 'lodash/isEmpty'
import debounce from 'lodash/debounce'
import omit from 'lodash/omit'

// const FILTER_TYPOLOGIES = 'typologies'
// const FILTER_STATES = 'states'

function getQueryFilterParams (query) {
  const nonFilterParams = ['sortby', 'direction', 'page']
  return omit(query, nonFilterParams)
}

export default {
  components: {
    InputSearch,
    ContestsOverviewFilters,
    ContestsOverviewResults,
    ButtonLoadMore
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      results: [],
      total: 0,
      hasNextPage: true
    }
  },
  computed: {
    query () {
      return this.$route.query
    },
    searchTerm () {
      return this.query.q
    },
    selectedFilters () {
      const facetFilterParams = omit(this.query, ['q', 'sortby', 'direction', 'page'])

      return Object.entries(facetFilterParams)
        .flatMap(([type, keys]) => keys.flatMap(key => [{ key, type }])) || []
    },
    sorting () {
      return {
        name: this.query.sortby,
        direction: this.query.direction
      }
    },
    page () {
      return this.query.page || 1
    },
    areFiltersApplied () {
      return !isEmpty(getQueryFilterParams(this.query))
    }  
  },
  watch: {
    $route: function (route, oldRoute) {
      this.fetchResults()

      // Re-fetch filters only if new route differs by filter parameters
      if (!isEqual(getQueryFilterParams(route.query), getQueryFilterParams(oldRoute.query))) {
        this.fetchFilters()
      }
    }
  },
  created () {
    this.fetchResults()
    this.fetchFilters()
  },
  methods: {
    onSearchTermChange (searchTerm) {
      this.updateQuery({
        q: isEmpty(searchTerm) ? undefined : searchTerm
      })
    },
    onSelectedFiltersChange (selectedFilters) {
      const filters = {}

      for (const filterType in this.filters) {
        filters[filterType] = selectedFilters
          .filter(({ type }) => type === filterType)
          .map(({ key }) => key)
      }

      this.updateQuery(filters)
    },
    onSortChange (sort) {
      if (!sort.name || !sort.direction) {
        this.updateQuery({ sortby: undefined, direction: undefined })
        return
      }

      this.updateQuery({
        sortby: sort.name,
        direction: sort.direction
      })
    },
    updateQuery (newQuery) {
      this.$router.push({
        query: {
          ...this.$route.query,
          page: undefined,
          ...newQuery
        }
      })
    },
    async fetchFilters () {
      const response = await this.axiosGet('contests-filters', this.query)

      const filters = {}
      for (const filterType in response) {
        filters[filterType] = []

        for (const [key, items] of Object.entries(response[filterType])) {
          filters[filterType].push({ key, title: key, items, type: filterType })
        }
      }
      this.filters = filters
    },
    async fetchResults () {
      const response = await this.axiosGet('contests', this.query)
      if (response.meta.current_page === 1) this.results = []

      this.results.push(...response.data)
      this.total = response.meta.total
      this.hasNextPage = response.meta.current_page < response.meta.last_page
    },
    async onLoadMore () {
      this.updateQuery({ page: parseInt(this.page) + 1 })
    },
    onClearFilters () {
      this.$router.push({ query: {} })
    }
  }
}
</script>
