<template>
  <a
    class="px-1 mr-2 hover:text-blue cursor-pointer text-sm"
    :href="url"
    v-on="$listeners"
  >
    ❪#<slot />❫
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
