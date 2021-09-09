<template>
  <article class="py-10 grid grid-cols-2 place-items-start items-center">
    <TagHash
      v-if="post.tags[0]"
      :url="tagUrl"
    >{{ post.tags[0].name }}</TagHash>
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
      :srcset="post.cover_image.srcset"
      :alt="post.title"
      sizes="1px"
      :src="post.cover_image.url"
      class="my-5 rounded-lg col-span-2"
      :width="post.cover_image.width"
      :height="post.cover_image.height"
      ref="img"
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
      return `${window.location.origin}/spravy?categories=${this.post.tags[0].name}`
    }
  },
  mounted () {
    // @TODO: try this.$nextTick or anything nicer then this
    setTimeout(() => {
      let size=this.$refs.img.getBoundingClientRect().width
      this.$refs.img.sizes = Math.ceil(size/window.innerWidth*100)+'vw';
    }, 500)
  }

}
</script>
