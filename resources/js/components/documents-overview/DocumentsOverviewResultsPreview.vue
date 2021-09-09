<template>
  <a
    :href="document.file.thumb"
    class="focus:outline-none hover:text-blue"
    target="_blank"
  >
    <!-- TODO: add icon when available -->
    Preview
  </a>
</template>

<script>
export default {
  props: {
    document: {
      type: Object,
      required: true
    }
  }
}
</script>
