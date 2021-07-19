<template>
  <a
    :href="url"
    class="group block leading-relaxed hover:text-blue"
  >
    <slot />
    <span
      class="opacity-0 inline-block transform group-hover:opacity-100 group-hover:translate-x-3 duration-200"
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
}
</script>
