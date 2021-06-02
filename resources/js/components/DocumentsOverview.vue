<template>
  <div>
    <DocumentsOverviewFilters
      v-model="selectedFilters"
      :filters="filters"
    />
    <DocumentsOverviewResults :results="results" />
    <div
      v-if="hasNextPage"
      class="mt-10 h-20 flex items-center"
    >
      <ButtonArrow
        v-if="!isLoading"
        class="text-xl"
        @click="onLoadMore"
      >
        {{ __('post.load_more') }}
      </ButtonArrow>
      <p v-else>
        {{ __('post.loading_more') }}
      </p>
    </div>
  </div>
</template>

<script>
import DocumentsOverviewResults from './DocumentsOverviewResults'
import DocumentsOverviewFilters from './DocumentsOverviewFilters'
import ButtonArrow from './atoms/buttons/ButtonArrow'

export default {
  components: {
    DocumentsOverviewFilters,
    DocumentsOverviewResults,
    ButtonArrow
  },
  data () {
    return {
      filters: {},
      selectedFilters: [],
      results: [],
      isLoading: false,
      hasNextPage: true
    }
  },
  watch: {
    selectedFilters: {
      immediate: true,
      async handler (newValue) {
        const response = await axios.get(`${window.location.origin}/api/documents`)
        this.results = response.data.data
      }
    }
  },
  async created () {
    const { data } = await axios.get(`${window.location.origin}/api/documents-filters`)

    const roles = []
    const topics = []
    const types = []

    for (const key in data.roles) {
      roles.push({ key: key, title: key, items: data.roles[key], params: '' })
    }

    for (const key in data.topics) {
      topics.push({ key: key, title: key, items: data.topics[key], params: '' })
    }

    for (const key in data.types) {
      types.push({ key: key, title: key, items: data.types[key], params: '' })
    }

    this.filters = {
      roles,
      topics,
      types
    }
  },
  methods: {
    onLoadMore () {
      // TODO: implement
    }
  }
}
</script>
