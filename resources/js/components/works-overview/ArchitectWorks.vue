<template>
  <div>

    <div class="text-xl tracking-tight leading-snug">Vlastné diela</div>

    <WorksOverviewResults
      v-model="sorting"
      :results="results"
      :total="total"
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
import WorksOverviewResults from './WorksOverviewResults'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'

export default {
  components: {
    WorksOverviewResults,
    ButtonLoadMore
  },
  props: {
    architectId: {
      type: String,
      required: true
    }
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      results: [],
      sorting: {
        name: null,
        year: null
      },
      total: 0,
      page: 1,
      hasNextPage: true
    }
  },
  watch: {
    sorting () {
      this.fetchData()
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      const [worksResponse] = await Promise.all([
        this.axiosGet('works', {'architect_id': this.architectId})
      ])

      this.results = worksResponse.data
      this.total = worksResponse.meta.total
      this.hasNextPage = worksResponse.meta.current_page < worksResponse.meta.last_page
    },
    async onLoadMore () {
      const params = {
        architect_id: this.architectId,
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
