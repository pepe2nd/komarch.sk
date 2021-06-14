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
    <!-- TODO: add universal has tag component -->
    <span
      v-for="(filter, index) in item.filters"
      :key="index"
    >
      {{ filter }}
    </span>
  </div>
</template>

<script>

export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>
