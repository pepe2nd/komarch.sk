<template>
  <a @click="goBack" class="group block leading-relaxed hover:text-blue cursor-pointer">
    <span
      class="inline-block transform group-hover:-translate-x-2 duration-200 icon-arrow-l-long"
      :class="external ? 'icon-arrow-r' : 'icon-arrow-r-long'"
    ></span>
    <slot />
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
  },
  methods: {
    goBack() {
      window.history.length > 2 ? window.history.back() : window.location.href = this.url
    }
  }
}
</script>