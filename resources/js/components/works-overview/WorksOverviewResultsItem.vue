<template>
  <div class="w-1/4 py-10">
    <div class="relative group">
      <!-- TODO: remove the replacement of localhost -->
      <img
        :src="item.cover_image.url.replace('localhost', 'localhost:8000')"
        :alt="item.name"
        class="rounded-2xl"
      >
      <h3 class="mt-4 group-hover:text-blue">
        <a
          :href="item.url"
          class="link-area"
        >
          {{ item.name }}
        </a>
      </h3>
    </div>
    <div class="flex flex-wrap mt-4">
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
