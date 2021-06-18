<template>
  <div class="py-10">
    <div class="relative group">
      <!-- TODO: remove the replacement of localhost -->
      <img
        v-if="item.cover_image"
        :srcset="item.cover_image.srcset"
        :alt="item.name"
        class="rounded-2xl"
        sizes="1px"
        :src="item.cover_image.url"
        :width="item.cover_image.width"
        :height="item.cover_image.height"
        ref="img"
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

import TagHash from './atoms/tags/TagHash'

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
    },
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
