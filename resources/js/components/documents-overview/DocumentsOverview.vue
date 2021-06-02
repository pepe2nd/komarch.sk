<template>
  <!-- TODO: Implement a nice spinner for loading state -->
  <div>
    <DocumentsOverviewFilters
      v-model="selectedFilters"
      :filters="filters"
    />
    <InputSearch
      v-model="searchTerm"
      class="mt-16 md:mt-8 md:max-w-sm"
      :placeholder="__('documents.search_placeholder')"
    />
    <DocumentsOverviewResults
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
import DocumentsOverviewResults from './DocumentsOverviewResults'
import DocumentsOverviewFilters from './DocumentsOverviewFilters'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'
import InputSearch from '../atoms/InputSearch'
import axiosGet from '../axiosGetMixin'

const FILTER_ROLES = 'roles'
const FILTER_TOPICS = 'topics'
const FILTER_TYPES = 'types'

export default {
  components: {
    InputSearch,
    DocumentsOverviewFilters,
    DocumentsOverviewResults,
    ButtonLoadMore
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      selectedFilters: [],
      searchTerm: null,
      sorting: {
        name: null,
        date: null
      },
      results: [],
      page: 1,
      hasNextPage: true
    }
  },
  computed: {
    filterParams () {
      const params = {
        roles: this.selectedFilters.filter(filter => filter.type === FILTER_ROLES).map(filter => filter.title),
        topics: this.selectedFilters.filter(filter => filter.type === FILTER_TOPICS).map(filter => filter.title),
        types: this.selectedFilters.filter(filter => filter.type === FILTER_TYPES).map(filter => filter.title)
      }

      if (this.sorting.name) {
        params.sortby = 'name'
        params.direction = this.sorting.name
      }

      if (this.sorting.date) {
        params.sortby = 'created_at'
        params.direction = this.sorting.date
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
      const [documentsResponse, filtersResponse] = await Promise.all([
        this.axiosGet('/api/documents', this.filterParams),
        this.axiosGet('/api/documents-filters', this.filterParams)
      ])

      const roles = []
      const topics = []
      const types = []

      for (const key in filtersResponse.roles) {
        roles.push({ key: key, title: key, items: filtersResponse.roles[key], type: FILTER_ROLES })
      }

      for (const key in filtersResponse.topics) {
        topics.push({ key: key, title: key, items: filtersResponse.topics[key], type: FILTER_TOPICS })
      }

      for (const key in filtersResponse.types) {
        types.push({ key: key, title: key, items: filtersResponse.types[key], type: FILTER_TYPES })
      }

      this.filters = {
        roles,
        topics,
        types
      }

      this.results = documentsResponse.data
      this.hasNextPage = documentsResponse.meta.current_page < documentsResponse.meta.last_page
    },
    async onLoadMore () {
      const params = {
        ...this.filterParams,
        page: this.page + 1
      }

      const documentsResponse = await this.axiosGet('/api/documents', params)

      this.page = documentsResponse.meta.current_page
      this.hasNextPage = documentsResponse.meta.current_page < documentsResponse.meta.last_page
      this.results.push(...documentsResponse.data)
    }
  }
}
</script>
