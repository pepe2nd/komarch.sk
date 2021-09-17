<template>
  <div>
    <WorksOverviewFilters
      :value="selectedFilters"
      :filters="filters"
      @input="onSelectedFiltersChange"
    />
    <div class="md:flex flex-wrap items-center">
      <div class="flex-1 md:max-w-sm">
        <h3 class="text-sm">
          {{ `${__('works.realisation_year')}:` }}
        </h3>
        <RangeSlider
          :value="yearRange"
          :min="yearRangeLimit.min"
          :max="yearRangeLimit.max"
          @input="onYearRangeChange"
        />
      </div>
      <InputSearch
        class="mt-16 md:mt-4 pb-1 md:ml-24 md:max-w-sm flex-1"
        :value="searchTerm"
        :placeholder="__('works.search_placeholder')"
        @input="onSearchTermChange"
      />
    </div>
    <div class="h-24 flex items-center">
      <ButtonClearFilters
        v-show="areFiltersApplied"
        class="mt-4"
        @click="onClearFilters"
      />
    </div>
    <WorksOverviewResults
      class="mt-16 md:mt-32"
      :sort="sorting"
      :results="results"
      :total="total"
      @sort="onSortChange"
    />
    <p
      v-if="results.length === 0"
      class="py-10"
    >
      {{ __('works.no_works') }}.
    </p>
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
import ButtonClearFilters from '../atoms/buttons/ButtonClearFilters'
import isEqual from 'lodash/isEqual'
import isEmpty from 'lodash/isEmpty'
import debounce from 'lodash/debounce'
import omit from 'lodash/omit'

function getQueryFilterParams (query) {
  const nonFilterParams = ['sortby', 'direction', 'page']
  return omit(query, nonFilterParams)
}

export default {
  components: {
    RangeSlider,
    WorksOverviewFilters,
    WorksOverviewResults,
    ButtonLoadMore,
    InputSearch,
    ButtonClearFilters
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      yearRangeLimit: {
        min: 1900,
        max: new Date().getFullYear()
      },
      results: [],
      total: 0,
      hasNextPage: false
    }
  },
  computed: {
    query () {
      return this.$route.query
    },
    yearRange () {
      return [
        this.query.year_from || this.yearRangeLimit.min,
        this.query.year_to || this.yearRangeLimit.max
      ]
    },
    searchTerm () {
      return this.query.q
    },
    selectedFilters () {
      const facetFilterParams = omit(this.query, ['year_from', 'year_to', 'q', 'sortby', 'direction', 'page'])

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
    onYearRangeChange: debounce(function (yearRange) {
      this.updateQuery({
        year_from: yearRange[0] === this.yearRangeLimit.min ? undefined : yearRange[0],
        year_to: yearRange[1] === this.yearRangeLimit.max ? undefined : yearRange[1]
      })
    }, 300),
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
        this.updateQuery({ sortby: undefined, direction: undefined, page: undefined })
        return
      }

      this.updateQuery({
        sortby: sort.name,
        direction: sort.direction,
        page: undefined
      })
    },
    updateQuery (newQuery) {
      this.$router.push({
        query: {
          ...this.$route.query,
          ...newQuery
        }
      })
    },
    async fetchFilters () {
      const response = await this.axiosGet('works-filters', this.query)

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
      const response = await this.axiosGet('works', this.query)
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
