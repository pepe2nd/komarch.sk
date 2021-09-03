<template>
  <article class="py-10 grid grid-cols-3 place-items-start items-center">
    <TagDate class="col-span-2 whitespace-nowrap">
      {{ tender.announced_at }}
      <span v-if="tender.finished_at"> – {{ tender.finished_at }}</span>
    </TagDate>
    <TagDate class="h-6 flex items-center">
      <span class="icon-clock mr-1" />
      {{ tender.days }}
    </TagDate>
    <h3 class="mt-1 text-xl col-span-3 tracking tight">
      <LinkTitle :url="tender.url">
        {{ tender.title }}
      </LinkTitle>
    </h3>
  </article>
</template>

<script>
import TagDate from './atoms/tags/TagDate'
import LinkTitle from './atoms/links/LinkTitle'

export default {
  components: {
    LinkTitle,
    TagDate
  },
  props: {
    tender: {
      type: Object,
      required: true
    }
  }
}
</script>
