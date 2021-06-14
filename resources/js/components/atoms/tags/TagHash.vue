<template>
  <a
    class="px-1 mr-2 hover:text-blue flex items-center cursor-pointer"
    :href="url"
    v-on="$listeners"
  >
    ❪<span class="text-sm">#
      <slot />
    </span>❫
  </a>
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      default: null
    }
  }
}
</script>
