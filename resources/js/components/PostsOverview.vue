<template>
  <div>
    <div class="mt-24 md:flex flex-wrap">
      <radio-button
        v-for="filter in filters"
        :key="filter.key"
        v-model="activeFilter"
        :disabled="isLoading"
        :option="filter"
        class="mr-12 py-2"
      />
    </div>
    <div class="h-10 md:h-20">
      <ButtonClearFilters
        v-show="activeFilter.key"
        @click="onCancel"
      />
    </div>
    <transition-group
      name="posts-overview"
      mode="out-in"
      class="lg:flex flex-wrap items-start lg:-ml-3"
    >
      <TeaserPostBig
        v-for="post in posts"
        :key="post.id"
        :post="post"
        class="lg:w-1/3 lg:p-3 mt-12"
      />
    </transition-group>
    <p
      v-if="posts.length === 0"
      class="py-10"
    >
      {{ __('post.no_posts') }}.
    </p>
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
import RadioButton from './atoms/RadioButton'
import TeaserPostBig from './TeaserPostBig'
import ButtonArrow from './atoms/buttons/ButtonArrow'
import ButtonClearFilters from './atoms/ButtonClearFilters'

export default {
  components: {
    ButtonClearFilters,
    ButtonArrow,
    RadioButton,
    TeaserPostBig
  },
  data () {
    return {
      filters: [],
      activeFilter: {},
      posts: [],
      page: 1,
      hasNextPage: true,
      isLoading: false,
      isError: false
    }
  },
  watch: {
    selectedOption: {
      immediate: true,
      handler () {
        this.fetchPage(1)
      }
    }
  },
  async created () {
    const { data } = await axios.get(`${window.location.origin}/api/posts-filters`)

    const importantFilter = { key: 'Dôležité', title: 'Dôležité', params: '&featured' }

    const filters = [
      importantFilter
    ]

    for (const key in data.categories) {
      if (key !== importantFilter.key) {
        filters.push({ key: key, title: key, params: `&categories=${key}` })
      }
    }

    this.filters = filters
  },
  methods: {
    onLoadMore () {
      this.fetchPage(this.page + 1)
    },
    onCancel () {
      this.activeFilter = {}
    },
    async fetchUrl (url) {
      try {
        this.isLoading = true
        const response = await axios.get(url)

        if (response.status !== 200) {
          this.isError = true
          return
        }

        return response.data
      } catch (error) {
        this.isError = true
      } finally {
        this.isLoading = false
      }
    },
    async fetchPage (pageNumber) {
      const { data, meta } = await this.fetchUrl(`${window.location.origin}/api/posts?page=${pageNumber}${this.activeFilter.params || ''}`)

      if (pageNumber === 1) {
        this.posts = data
      } else {
        this.posts.push(...data)
      }

      this.page = meta.current_page
      this.hasNextPage = meta.current_page < meta.last_page
    }
  }
}
</script>

<style>
.posts-overview-enter-active {
  @apply transition-all duration-700;
}

.posts-overview-enter {
  @apply transform opacity-0 translate-y-5;
}
</style>
