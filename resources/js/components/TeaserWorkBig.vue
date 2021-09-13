<template>
  <div class="py-10 mb-10">
    <div class="relative group">
      <img
        v-if="item.cover_image"
        ref="img"
        :srcset="item.cover_image.srcset"
        :alt="item.name"
        class="rounded-2xl group-hover:rounded-none transition transition-all"
        sizes="1px"
        :src="item.cover_image.url"
        :width="item.cover_image.width"
        :height="item.cover_image.height"
      >
      <h3 class="mt-4 group-hover:text-blue leading-normal">
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
      >{{ filter }}</TagHash>
    </div>
    <div class="flex flex-wrap mt-4">
      <a
        v-for="architect in item.architects"
        :key="architect.id"
        :href="architect.url"
        class="group inline-block leading-normal text-blue mr-2"
      >
        {{ architect.first_name }} {{ architect.last_name }}
        <span class="inline-block transform group-hover:translate-x-1 group-hover:-translate-y-1 duration-200 icon-arrow-tr" />
      </a>
      <span
        v-for="architect in item.other_architects"
        :key="architect.slug"
        class="group inline-block leading-normal mr-2"
      >
        {{ architect.name }}
      </span>
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
  mounted () {
    if (this.item.cover_image) {
      const size = this.$refs.img.getBoundingClientRect().width
      this.$refs.img.sizes = Math.ceil(size / window.innerWidth * 100) + 'vw'
    }
  },
  methods: {
    onTagClicked (filter) {
      console.log(filter) // TODO
    }
  }
}
</script>
