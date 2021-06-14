<template>
  <div class="w-1/4 py-10">
    <!-- TODO: remove the replacement of localhost -->
    <img
      :src="item.cover_image.url.replace('localhost', 'localhost:8000')"
      :alt="item.name"
      class="rounded-2xl"
    >
    <h3 class="mt-2">
      <a :href="item.url">
        {{ item.name }}
      </a>
    </h3>
    <div class="flex flex-wrap">
      <TagHash
        v-for="(filter, index) in item.filters"
        :key="index"
        @click="onTagClicked(filter)"
      >
        {{ filter }}
      </TagHash>
    </div>
  </div>
</template>

<script>

import TagHash from '../atoms/tags/TagHash'

export default {
  components: {
    TagHash
  },
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  methods: {
    onTagClicked (filter) {
      console.log(filter)
    }
  }
}
</script>
