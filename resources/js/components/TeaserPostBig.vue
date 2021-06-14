<template>
  <article class="py-10 grid grid-cols-2 place-items-start items-center">
    <TagHash
      v-if="post.tags[0]"
      :url="tagUrl"
    >
      {{ post.tags[0].name }}
    </TagHash>
    <TagDate>{{ post.date }}</TagDate>
    <h3 class="mt-2 text-xl col-span-2 tracking-tight leading-snug">
      <LinkTitle :url="post.url">
        {{ post.title }}
      </LinkTitle>
    </h3>
    <p class="mt-5 col-span-2 leading-snug">
      {{ post.perex }}
    </p>
    <img
      v-if="post.cover_image"
      :src="post.cover_image.url"
      :alt="post.title"
      class="my-5 rounded-lg col-span-2"
    >
  </article>
</template>

<script>
import TagHash from './atoms/tags/TagHash'
import TagDate from './atoms/tags/TagDate'
import LinkTitle from './atoms/links/LinkTitle'

export default {
  components: {
    TagHash,
    TagDate,
    LinkTitle
  },
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  computed: {
    tagUrl () {
      return `${window.location.origin}/spravy?categories[]=${this.post.tags[0].name}`
    }
  }
}
</script>
