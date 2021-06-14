<template>
  <a
    class="px-1 mr-4 hover:text-blue flex items-center"
    :href="url"
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
      required: true
    }
  }
}
</script>
