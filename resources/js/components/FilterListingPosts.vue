<template>
  <section class="border-b border-black md:border-b-0 py-10">
    <h2 class="text-2xl mb-10">
      <LinkArrow url="/spravy">
        {{ __('posts.title') }}
      </LinkArrow>
    </h2>

    <div class="md:flex flex-wrap">
      <radio-button
        v-for="option in options"
        :key="option.key"
        v-model="selectedOption"
        :option="option"
        class="mr-12 py-2"
      />
    </div>

    <transition
      name="items-list"
      mode="out-in"
    >
      <div
        :key="displayOption.key"
        class="flex gap-10 mt-5"
      >
        <template v-if="posts.length > 0">
          <TeaserPostBig
            v-for="post in posts"
            :key="post.id"
            :post="post"
            class="lg:w-1/3"
            data-grid-item
          />
        </template>
        <p
          v-else
          class="py-10"
        >
          {{ __('posts.no_posts') }}
        </p>
      </div>
    </transition>
  </section>
</template>

<script>
import LinkArrow from './atoms/links/LinkArrow'
import RadioButton from './atoms/RadioButton'
import TeaserPostBig from './TeaserPostBig'

export default {
  components: {
    TeaserPostBig,
    LinkArrow,
    RadioButton
  },
  props: {
    options: {
      type: Array,
      default: () => [
        { key: 'newest', title: 'Najnovšie', params: '' },
        { key: 'important', title: 'Dôležité', params: '?categories=Dôležité' },
        { key: 'Vzdelávanie', title: 'Vzdelávanie', params: '?categories=Vzdelávanie' }
      ]
    }
  },
  data () {
    return {
      posts: [],
      selectedOption: this.options[0],
      displayOption: this.options[0]
    }
  },
  watch: {
    selectedOption: {
      immediate: true,
      async handler (newValue) {
        const response = await axios.get(`/api/posts${newValue.params}`, { params: { per_page: 3 } })
        this.displayOption = newValue
        this.posts = response.data.data
      }
    }
  }
}
</script>
