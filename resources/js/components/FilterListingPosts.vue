<template>
  <section class="border-b border-black md:border-b-0 py-10">
    <h2 class="text-xl mb-10">
      <LinkArrow url="/spravy">
        {{ __('posts.title') }}
      </LinkArrow>
    </h2>

    <radio-button
      v-for="option in options"
      :key="option.key"
      v-model="selectedOption"
      :option="option"
    />

    <transition
      name="items-list"
      mode="out-in"
    >
      <div
        :key="displayOption.key"
        class="mt-10"
      >
        <template v-if="posts.length > 0">
          <div
            v-for="(post, index) in posts"
            :key="index"
          >
            <TeaserSka :post="post" />
          </div>
        </template>
        <p
          v-else
          class="py-10"
        >
          {{ __('posts.no_posts') }}
        </p>
      </div>
    </transition>

    <LinkArrow url="/spravy">
      {{ __('posts.title') }}
    </LinkArrow>
  </section>
</template>

<script>
import LinkArrow from './atoms/links/LinkArrow'
import TeaserSka from './TeaserSka'
import RadioButton from './atoms/RadioButton'

export default {
  components: {
    TeaserSka,
    LinkArrow,
    RadioButton
  },
  props: {
    options: {
      type: Array,
      default: () => [
        { key: 'newest', title: 'Najnovšie', params: '' },
        { key: 'important', title: 'Dôležité', params: '?featured' },
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
        const response = await axios.get(`/api/posts${newValue.params}`)
        this.displayOption = newValue
        this.posts = response.data.data
      }
    }
  }
}
</script>
