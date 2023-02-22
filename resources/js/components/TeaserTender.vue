<template>
  <article class="py-10 grid grid-cols-2 place-items-start items-center group">
    <TagDate class="col-span-3 whitespace-nowrap">
      {{ tender.announced_at }}
      <span v-if="tender.next_proposal"> – {{ tender.next_proposal }}</span>
    </TagDate>
    <TagDate class="col-span-2 h-6 flex items-center whitespace-nowrap" v-if="tender.next_proposal" :title="tender.next_proposal">
      <span class="icon-clock mr-1" />
      {{ tender.next_proposal_diff }}
    </TagDate>
    <h3 class="mt-2 text-2xl col-span-2 tracking-tight leading-snug">
      <LinkTitle :url="tender.url">
        {{ tender.title }}
      </LinkTitle>
    </h3>
    <a :href="tender.url" class="w-full d-block col-span-2">
      <img
        v-if="tender.cover_image"
        :srcset="tender.cover_image.srcset"
        :alt="tender.title"
        sizes="1px"
        :src="tender.cover_image.url"
        class="my-5 rounded-2xl col-span-2 group-hover:rounded-none transition"
        :width="tender.cover_image.width"
        :height="tender.cover_image.height"
        ref="img"
        @load="onImgLoad"
      />
      <NoImage class="my-5" v-else></NoImage>
    </a>
  </article>
</template>

<script>
import TagDate from './atoms/tags/TagDate'
import LinkTitle from './atoms/links/LinkTitle'
import NoImage from "./atoms/NoImage";

export default {
  components: {
    LinkTitle,
    TagDate,
    NoImage
  },
  props: {
    tender: {
      type: Object,
      required: true
    }
  },
  methods: {
    onImgLoad() {
      const size = this.$refs.img.getBoundingClientRect().width;
      this.$refs.img.sizes = Math.ceil((size / window.innerWidth) * 100) + "vw";
    }
  }
}
</script>
