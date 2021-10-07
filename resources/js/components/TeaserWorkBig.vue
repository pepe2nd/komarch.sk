<template>
  <div class="py-10 mb-0 md:mb-10">
    <div class="relative group">
      <img
        v-if="item.cover_image"
        ref="img"
        :srcset="item.cover_image.srcset"
        :alt="item.name"
        class="rounded-2xl group-hover:rounded-none transition"
        sizes="1px"
        :src="item.cover_image.url"
        :width="item.cover_image.width"
        :height="item.cover_image.height"
      >
      <NoImage v-else />
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
        v-for="award in item.awards"
        :key="award.id"
        :url="'/diela?awards[]=' + award.name"
      >{{ award.name }}</TagHash>
      <TagHash
        v-if="item.location_district"
        :url="'/diela?location_districts[]=' + item.location_district"
      >{{ item.location_district }}</TagHash>
      <TagHash
        v-if="item.year"
        :url="'/diela?year_from=' + item.year + '&year_to=' + item.year"
      >{{ item.year }}</TagHash>
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
import NoImage from './atoms/NoImage'

export default {
  components: {
    TagHash,
    NoImage
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
