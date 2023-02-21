<template>
  <a :href="url" class="group block pr-4 leading-relaxed hover:text-blue">
    <slot />
    <span
      class="inline-block transform opacity-0 duration-200 group-hover:translate-x-2 group-hover:opacity-100"
      :class="external ? 'icon-arrow-r' : 'icon-arrow-r-long'"
    />
  </a>
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    },
    external: {
      type: Boolean,
      default: false
    }
  }
};
</script>
