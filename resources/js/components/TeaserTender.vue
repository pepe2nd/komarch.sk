<template>
  <article class="py-10 grid grid-cols-5 place-items-start items-center">
    <TagDate class="col-span-3 whitespace-nowrap">
      {{ tender.announced_at }}
      <span v-if="tender.next_proposal"> – {{ tender.next_proposal }}</span>
    </TagDate>
    <TagDate class="col-span-2 h-6 flex items-center whitespace-nowrap" v-if="tender.next_proposal" :title="tender.next_proposal">
      <span class="icon-clock mr-1" />
      {{ tender.next_proposal_diff }}
    </TagDate>
    <h3 class="mt-1 text-xl col-span-5 tracking tight">
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
