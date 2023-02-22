<template>
  <FilterListing
    v-model="selectedOption"
    :fetched-option="fetchedOption"
    :options="options"
    :items="contests"
  >
    <template #before-list>
      <h2 class="text-2xl mb-10">
        <LinkArrow url="/sutaze">
          {{ __('contests.title') }}
        </LinkArrow>
      </h2>
    </template>

    <template #empty-list>
      <p class="py-10">
        {{ __('contests.no_results') }}
      </p>
    </template>

    <template #list-item="{ item }">
      <TeaserTender :tender="item" />
    </template>

  </FilterListing>
</template>

<script>
import TeaserTender from './TeaserTender'
import LinkArrow from './atoms/links/LinkArrow'
import FilterListing from './FilterListing'

export default {
  components: {
    FilterListing,
    LinkArrow,
    TeaserTender
  },
  props: {
    options: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      selectedOption: this.options[0],
      contests: [],
      fetchedOption: null
    }
  },
  watch: {
    selectedOption (value) {
      this.fetch()
    }
  },
  created () {
    this.fetch()
  },
  methods: {
    async fetch () {
      let sort = {
        name: 'deadline_at',
        direction: 'asc'
      }

      if (this.selectedOption.key == 'upcoming') {
        sort.name = 'title'
      } else if (this.selectedOption.key == 'finished') {
        sort.name = 'results_published_at'
        sort.direction = 'desc'
      }

      const response = await axios.get('/api/contests', { params: { per_page: 3, state: this.selectedOption.key, sortby: sort.name, direction: sort.direction } })
      this.fetchedOption = this.selectedOption.key
      this.contests = response.data.data
    }
  }
}
</script>
