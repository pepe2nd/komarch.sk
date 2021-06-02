<template>
  <div>
    <DocumentsOverviewFilters
      v-model="selectedFilters"
      :filters="filters"
    />
    <DocumentsOverviewResults
      v-model="sorting"
      :results="results"
    />
    <ButtonLoadMore
      v-if="hasNextPage"
      :is-loading="isLoading"
      @click="onLoadMore"
    />
  </div>
</template>

<script>
import DocumentsOverviewResults from './DocumentsOverviewResults'
import DocumentsOverviewFilters from './DocumentsOverviewFilters'
import ButtonLoadMore from './atoms/buttons/ButtonLoadMore'

export default {
  components: {
    DocumentsOverviewFilters,
    DocumentsOverviewResults,
    ButtonLoadMore
  },
  data () {
    return {
      filters: {},
      selectedFilters: [],
      sorting: {
        name: null,
        date: null
      },
      results: [],
      isLoading: false,
      hasNextPage: true
    }
  },
  watch: {
    sorting () {
      this.fetchData()
    },
    selectedFilters () {
      this.fetchData()
    }
  },
  async created () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      try {
        this.isLoading = true

        const FILTER_ROLES = 'roles'
        const FILTER_TOPICS = 'topics'
        const FILTER_TYPES = 'types'

        const params = {
          roles: this.selectedFilters.filter(filter => filter.type === FILTER_ROLES).map(filter => filter.title),
          topics: this.selectedFilters.filter(filter => filter.type === FILTER_TOPICS).map(filter => filter.title),
          types: this.selectedFilters.filter(filter => filter.type === FILTER_TYPES).map(filter => filter.title)
        }

        const [documentsResponse, filtersResponse] = await Promise.all([
          axios.get(`${window.location.origin}/api/documents`, { params }),
          axios.get(`${window.location.origin}/api/documents-filters`, { params })
        ])

        const roles = []
        const topics = []
        const types = []

        for (const key in filtersResponse.data.roles) {
          roles.push({ key: key, title: key, items: filtersResponse.data.roles[key], type: FILTER_ROLES })
        }

        for (const key in filtersResponse.data.topics) {
          topics.push({ key: key, title: key, items: filtersResponse.data.topics[key], type: FILTER_TOPICS })
        }

        for (const key in filtersResponse.data.types) {
          types.push({ key: key, title: key, items: filtersResponse.data.types[key], type: FILTER_TYPES })
        }

        this.filters = {
          roles,
          topics,
          types
        }

        this.results = documentsResponse.data.data
        this.hasNextPage = documentsResponse.data.meta.current_page < documentsResponse.data.meta.last_page
      } catch (e) {
        console.error(e)
      } finally {
        this.isLoading = false
      }
    },
    onLoadMore () {
      // TODO: implement
    }
  }
}
</script>
