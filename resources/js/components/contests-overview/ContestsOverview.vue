<template>
  <!-- TODO: Implement a nice spinner for loading state -->
  <div>
    <div class="mb-8 md:flex flex-wrap">
      <radio-button v-for="option in availableStates" :key="option.key" :value="{ key: selectedState }" 
        :option="option" name="state" class="mr-12 py-2" @input="onSelectedStateChange" />
    </div>
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
    <OngoingContestsOverviewResults
      v-if="selectedState == 'ongoing'"
      :sort="sorting"
      :results="results"
      :total="total"
      @sort="onSortChange"
    />
    <UpcomingContestsOverviewResults
      v-else-if="selectedState == 'upcoming'"
      :sort="sorting"
      :results="results"
      :total="total"
      @sort="onSortChange"
    />
    <FinishedContestsOverviewResults
      v-else-if="selectedState == 'finished'"
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
import RadioButton from '../atoms/RadioButton'
import OngoingContestsOverviewResults from './OngoingContestsOverviewResults'
import UpcomingContestsOverviewResults from './UpcomingContestsOverviewResults'
import FinishedContestsOverviewResults from './FinishedContestsOverviewResults'
import ContestsOverviewFilters from './ContestsOverviewFilters'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'
import InputSearch from '../atoms/InputSearch'
import axiosGet from '../axiosGetMixin'
import isEqual from 'lodash/isEqual'
import isEmpty from 'lodash/isEmpty'
import omit from 'lodash/omit'

function getQueryFilterParams (query) {
  const nonFilterParams = ['sortby', 'direction', 'page']
  return omit(query, nonFilterParams)
}

const stateOptions = ['ongoing', 'upcoming', 'finished'];

export default {
  components: {
    InputSearch,
    ContestsOverviewFilters,
    OngoingContestsOverviewResults,
    UpcomingContestsOverviewResults,
    FinishedContestsOverviewResults,
    ButtonLoadMore,
    RadioButton
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      results: [],
      total: 0,
      hasNextPage: true,
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
      const facetFilterParams = omit(this.query, ['q', 'sortby', 'direction', 'page', 'state'])

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
    selectedState () {
      return this.query.state || stateOptions[0]
    },
    availableStates () {
      let states = []
      for (const state of stateOptions) {
        states.push({
          key: state, title: this.__('contests.' + state) })
      }
      return states
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
    onSelectedStateChange (newState) {
      let sort = {
        name: 'deadline_at',
        direction: 'asc'
      }

      if (newState.key == 'upcoming') {
        sort.name = 'title'
      } else if (newState.key == 'finished') {
        sort.name = 'results_published_at'
        sort.direction = 'desc'
      }

      this.updateQuery({ state: newState.key, sortby: sort.name, direction: sort.direction })
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
